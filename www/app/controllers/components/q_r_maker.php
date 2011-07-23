<?php

/**
 * QRMakerComponent
 * 
 * Component for retrieving an augmented reality marker with a
 * given message encoded in its QR code.  If the file has already been
 * generated and cached on the server, its URL is simply returned.
 * Not bad for a couple hours' work!
 * 
 * @author ross
 *****************************************************************************/
class QRMakerComponent extends Object
{
	var $name = 'QRMaker';
	var $controller;
	
	/**
	 * Start-up the component
	 */
	function initialize(&$controller, $settings)
	{
		App::import('Sanitize');
		$this->controller =& $controller;
		$this->_set($settings);
	}
	
	/**
	 * Get an augmented reality marker image URL
	 */
	function getMarkerImageURL($msg)
	{
		$msg = Sanitize::paranoid($msg);
		$fileName = $this->getFileName(true, $msg);
		
		if(!file_exists($fileName))
		{
			$this->getQRSourceImage($msg);
			$this->MakeARMarker($msg);
		}
		
		$fileName = str_replace(Configure::read('QRMaker.docroot'), Configure::read('QRMaker.webroot'), $fileName);
		
		return $fileName;
	}
	
	/**
	 * Get the QR image from the API (defaults to 300px square)
	 * http://www.phpriot.com/articles/download-with-curl-and-php
	 * http://nadeausoftware.com/articles/2007/06/php_tip_how_get_web_page_using_curl
	 * 
	 * @param String $msg
	 */
	function getQRSourceImage($msg)
	{
		$url = "http://miniqr.com/api/create.php?content=$msg&rtype=imageredirect";
		$path = $this->getFileName(false, $msg);
		$fp = fopen($path, 'w');
		
		$options = array(
	        CURLOPT_RETURNTRANSFER => true,     // return web page
	        CURLOPT_HEADER         => false,    // don't return headers
	        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
	        CURLOPT_ENCODING       => "",       // handle all encodings
	        CURLOPT_USERAGENT      => "spider", // who am i
	        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
	        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
	        CURLOPT_TIMEOUT        => 120,      // timeout on response
	        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	        CURLOPT_FILE		   => $fp
	    );
		
		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		$data = curl_exec($ch);
		curl_close($ch);
		fclose($fp);
	}
	
	/**
	 * Generate an AR marker based on the requested message
	 * http://www.codingforums.com/showthread.php?t=72317
	 * 
	 * @param String $msg
	 */
	function MakeARMarker($msg)
	{
		//load up the QR marker we want to use
		$qrImage = imagecreatefrompng($this->getFileName(false, $msg));
		$qrImageW = imagesx($qrImage);
		$qrImageH = imagesy($qrImage);
		
		//load up the base white image for the marker
		$whiteImage = imagecreatefrompng(Configure::read('QRMaker.docroot') . '/white.png');
		$whiteImageW = imagesx($whiteImage);
		$whiteImageH = imagesy($whiteImage);
		
		//load up the marker to lay on top of the QR
		$markerImage = imagecreatefrompng(Configure::read('QRMaker.docroot') . '/marker.png'		);
		$markerImageW = imagesx($markerImage);
		$markerImageH = imagesy($markerImage);
		
		//lay the QR on the white BG at offset 50,50
		imagealphablending($whiteImage, true);
		imagecopy($whiteImage, $qrImage, 50, 49, 0, 0, $qrImageW, $qrImageH);
		
		//lay the marker on top of the QR at offset 0,0
		imagecopy($whiteImage, $markerImage, 0, 0, 0, 0, $markerImageW, $markerImageH);
		
		//write the finished image sammich out to the file destination
		imagepng($whiteImage, $this->getFileName(true, $msg));
		
		//cleanup
		imagedestroy($qrImage);
		imagedestroy($whiteImage);
		imagedestroy($markerImage);
	}
	
	/**
	 * Generate a local file name based on the known qualities of a QR/AR.
	 * @param unknown_type $isMarker
	 * @param unknown_type $msg
	 */
	function getFileName($isMarker, $msg)
	{
		return Configure::read('QRMaker.docroot') . '/' . ($isMarker ? 'ar_' : 'qr_') . $msg . '.png';
	}
}