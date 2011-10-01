<?php
function rss_transform($rss_data) {
	return array(
		'title' => $rss_data['ContentContainer']['title'],
		'link' => array('controller' => 'content_containers', 'action' => 'index', $rss_data['ContentContainer']['id']),
		'guid' => array('controller' => 'content_containers', 'action' => 'index', 'ext' => 'rss', $rss_data['ContentContainer']['id']),
		'description' => strip_tags($rss_data['ContentContainer']['description']),
		'pubDate' => $rss_data['ContentContainer']['created'],				
				);
}
$this->set('rss_data', $rss->items($rss_data, 'rss_transform'));

?>