/**
 * @file
 * Sharing Links Script
 */

jQuery(function($){
	setupSharing();
});

// Sets up the sharing links
function setupSharing() {
	$sharingLinks = jQuery('.sharing-list a:not([data-include-script]):not(.email)');
	$sharingLinks.click(function(e){
		href = this.getAttribute('href');
		openWindow(href, 'Share');
		e.preventDefault();
	});
	var $scriptLinks = jQuery('.sharing-list a[data-include-script]');
	$scriptLinks.click(function(e){
		e.preventDefault(); // stop default
		// show loading indicator
		faLoadingIndicator(jQuery(this), 2000);
		// get script src
		var scriptToLoad = jQuery(this).attr('data-include-script');
		// load script
		var s = document.createElement('script');
		s.setAttribute('type','text/javascript');
		s.setAttribute('charset','UTF-8');
		s.setAttribute('src',scriptToLoad);
		document.body.appendChild(s);
	});
}

// function to open urls in a new window (used by sharing)
function openWindow(url, title) {
	var winWidth = 700;
	var winHeight = 326;
	var left = (screen.width/2)-(winWidth/2);
	var top = (screen.height/2)-(winHeight/2);
	window.open(
		url, // url
		title, // window name
		'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, height='+winHeight+', width='+winWidth+', left='+left+', top='+top
	);
}

// show font awesome loading indicator
function faLoadingIndicator($el, duration) {
	$icon = $el.find('.fa');
	var initialClasses = $icon.attr('class').split(' ');
	var loadingClasses = ['fa', 'fa-spinner', 'fa-spin', 'fa-fw'];
	removeClasses($icon, initialClasses);
	addClasses($icon, loadingClasses);
	setTimeout(function(){
		removeClasses($icon, loadingClasses);
		addClasses($icon, initialClasses);
	}, duration);
}

// class management helper functions
function removeClasses($el, classes) {
	for (i=0; i<classes.length; i++) {
		$el.removeClass(classes[i]);
	}
}
function addClasses($el, classes) {
	for (i=0; i<classes.length; i++) {
		$el.addClass(classes[i]);
	}
}