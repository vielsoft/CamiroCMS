<?php
$feedview = $this->params['controller'];
if($feedview == 'contents' OR $feedview =='content_containers' ){
	
	//Give Frontpage rss if user is in the frontpage, otherwise, just append .rss to
	//current link
	if($this->params['pass']['0'] != "front") {
		$feedlink = $this->here.'.rss';
	} else {
		$feedlink = $this->here.'contents/index/front.rss';
	}

	//Give Frontpage rss if user attempts to subscribe to an individual item
	if($feedview == 'contents' AND $this->params['action'] == 'view'){
		$feedlink = $this->base.'/contents/index/front.rss';
	}

	$feedtitle="Camiro-CMS";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"$feedtitle\" href=\"$feedlink\" />";
}
?>