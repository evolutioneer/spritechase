//My very first Node.js app - a smarter build-time CSS and JS compressor

//require the system libraries as globals
var sys = require('sys');
var exec = require('child_process').exec;
var fs = require('fs');
var less = require('/usr/local/lib/node_modules/less');

var CompyTable = (function() {
	var path = 'scripts/build/yuicompress_table.json';
	var data = {};
	
	return {
		path: path,
		data: data
	};
})();

var Compy = (function()
{ 
	//Shell path variables
	var getSnapshotPath = 'scripts/build/get_snapshot';
	var yuiCompressorPath = 'java -jar /var/www/lib/yuicompressor/build/yuicompressor-2.4.7pre.jar';
	
	//Application vars

	//Performs the compression
	//-------------------------------------------------------------------------
	var compress = function(extension, options)
	{
		var snapshot = [];
		
		exec(getSnapshotPath + ' www ' + extension, function(error, stdout, stderr) {
			snapshot = stdout;
			doCompress(parseSnapshot(snapshot, extension), extension, options);
		});
	};
	
	//-------------------------------------------------------------------------
	var doCompress = function(toCompress, extension, options)
	{
		var toProcessCt = toCompress.length;
		var processedCt = 0;
		options = (options ? ' ' + options : '');
		
		for(i in toCompress)
		{
			var outName = toCompress[i].match(/^(.*)?\..*$/, 'gi')[1] + '.min.' + extension;
			exec(yuiCompressorPath + options + ' ' + toCompress[i] + ' -o ' + outName,
				function(err, stdout, stderr) {
					if(err) sys.puts('[YUICOMPRESS] !!! error compressing file "' + outName + '": ' + err);
					else sys.puts('[YUICOMPRESS] ... compressed "' + outName + '"');
					
					if(toProcessCt == ++processedCt) save();
			});
		}
	};
	
	//Compiles less files into CSS
	//-------------------------------------------------------------------------
	var compile = function(extension) {
		var snapshot = [];
		
		exec(getSnapshotPath + ' www ' + extension, function(error, stdout, stderr) {
			snapshot = stdout;
			doCompile(parseSnapshot(snapshot, extension), extension);
		});
	};
	
	//-------------------------------------------------------------------------
	var doCompile = function(toCompile)
	{
		var toCompileCt = toCompile.length;
		var compiledCt = 0;
		
		for(i in toCompile)
		{
			var inName = toCompile[i];
			var outName = toCompile[i].match(/^(.*)?\..*$/, 'gi')[1] + '.css';
			var parser = new (less.Parser)({
				paths: ['.', './www/app/webroot/css'],
				filename: inName
			});
			
			fs.readFile(inName, 'utf-8', function(err, data) {
				
				parser.parse(data, function(err, tree) {
					if(err)
					{
						sys.puts('[LESS] !!! error parsing "' + inName + '": ' + err);
					}
					
					else
					{
						fs.writeFile(outName, tree.toCSS(), function(err) {
							if(err) sys.puts('[LESS] !!! error writing "' + outName + '": ' + outName);
							else sys.puts('[LESS] ... Successfully saved "' + outName + '"');
						});
					}
				});
			});
		}
	};
	
	//-------------------------------------------------------------------------
	var parseSnapshot = function(snapshotData, extension)
	{
		var rows = snapshotData.split('\n');
		var output = [];
		var row, file, time;
		
		for(i in rows)
		{
			row = rows[i].split('\t');
			if(!row[1]) continue;
			
			time = row[0];
			file = row[1];
			
			if(CompyTable.data[file] != time)
			{
				output.push(file);
				CompyTable.data[file] = time;
			}
		}
		
		sys.puts('[COMPY] ' + output.length + ' of ' + rows.length + ' ' + extension + ' files have been changed since last build');
		
		return output;
	};

	// PUBLIC INTERFACE -------------------------------------------------------
	var save = function()
	{
		fs.writeFile(CompyTable.path, JSON.stringify(CompyTable.data), function(err) {
			if(err) sys.puts('[COMPY] !!! error saving CompyTable: ' + err);
			else
			{
				sys.puts('[COMPY] Successfully saved CompyTable');
			}
		});
	};
	
	return {
		compress: compress,
		compile: compile,
		save: save
	};
})();

//Once we have our file list, we use JSON.parse to read it to a traversable JSON object and JSON.stringify to prepare for writing it back
fs.readFile(CompyTable.path, 'utf-8', function(err, data) {
	CompyTable.data = JSON.parse(data) || '{}';
	//$$debug compy is behaving like a non-blocking asynchronous little angelic PIMA, and sync/threads packages aren't installing.  Disabling compile for now.
	//Compy.compile('more');
	Compy.compress('js', '--line-break 800');
	Compy.compress('css', '--line-break 800 --type css');
});