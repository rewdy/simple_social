<?php

/*

Share Links
----------

PHP function to generate sharing links

*/


function get_share_links($url, $title, $class = 'sharing-list', $icon_prefix = 'fa fa-') {
	if (isset($url) && isset($title)) {
		$url = urlencode($url);
		$title = urlencode($title);

		$services['facebook'] = array(
			'label' => 'Facebook',
			'url'	=> 'http://www.facebook.com/sharer.php?s=100&amp;p[title]={{title}}&amp;p[url]={{url}}',
			'icon'	=> 'facebook',
		);
		$services['twitter'] = array(
			'label' => 'Twitter',
			'url'	=> 'https://twitter.com/intent/tweet?url={{url}}&amp;text={{title}}',
			'icon'	=> 'twitter',
		);
		// $services['pinterest'] = array(
		// 	'label'	=> 'Pinterest',
		// 	'url'	=> 'http://www.pinterest.com/pin/create/bookmarklet/?url={{url}}&description={{title}}',
		// 	'icon'	=> 'pinterest',
		// 	'extra' => 'data-include-script="https://assets.pinterest.com/js/pinmarklet.js?r=' . rand(0, 99999999) . '"',
		// );
		$services['tumblr'] = array(
			'label'	=> 'Tumblr',
			'url'	=> 'http://www.tumblr.com/share/?url={{url}}&description={{title}}',
			'icon'	=> 'tumblr',
		);
		$services['gplus'] = array(
			'label'	=> 'Google +',
			'url'	=> 'https://plus.google.com/share?url={{url}}',
			'icon'	=> 'google-plus',
		);
		$services['email']	= array(
			'label'	=> 'Email',
			'url'	=> 'mailto:?&amp;Subject={{title}}&amp;Body={{url}}',
			'icon'	=> 'envelope',
			'extra' => 'target="_blank"',
		);

		// build the output
		$output = '<ul class="' . $class . '">' . "\n";
		foreach ($services as $key => $service) {
			$extra = (isset($service['extra'])) ? ' '.$service['extra'] : '';
			$output .= "\t" . '<li><a href="'.$service['url'].'" class="'.$key.'"'.$extra.'><i class="{{icon_prefix}}'.$service['icon'].'"></i> <span class="text">'.$service['label'].'</span></a></li>' . "\n";
		}
		$output .= '</ul>';

		$output = preg_replace('/{{url}}/', $url, $output);
		$output = preg_replace('/{{title}}/', $title, $output);
		$output = preg_replace('/{{icon_prefix}}/', $icon_prefix, $output);

		return $output;
	} else {
		// not enought data. return empty string.
		return '';
	}
}
// function to echo the links like wp
function share_links($url, $title, $class = 'sharing-list', $icon_prefix = 'fa fa-') {
	echo get_share_links($url, $title, $class, $icon_prefix);
}