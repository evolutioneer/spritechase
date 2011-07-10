var myScroll;

$(document).ready(function() {
	myScroll = new iScroll('dialog-wrapper');
	$(window).bind('reorient', function() {
		setTimeout(function() {
			window.scrollTo(0, 1);
			myScroll.refresh();
		}, 100);
	});
	$.reorient.start();
});