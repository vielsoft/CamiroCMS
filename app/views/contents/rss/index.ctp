<?php
function rss_transform($rss_data) {
	return array(
		'title' => $rss_data['Content']['title'],
		'link' => array('controller' => 'contents', 'action' => 'view', $rss_data['Content']['slug']),
		'guid' => array('controller' => 'contents', 'action' => 'view', 'ext' => 'rss', $rss_data['Content']['id']),
		'description' => strip_tags($rss_data['Content']['contentbody']),
		'pubDate' => $rss_data['Content']['created'],				
				);
}
$this->set('rss_data', $rss->items($rss_data, 'rss_transform'));

?>