<?php
if(isset($pathway)){
	echo "You are here: <a href=\"{$html->url('/')}\">Home</a>";
	foreach($pathway as $path){
		echo ' | '.$html->link($path['ContentContainer']['title'],array('controller'=>'content_containers','action'=>'index',$path['ContentContainer']['id']));
	}
	if(isset($contents)){
		if($this->params['controller'] == 'contents' AND $this->params['action'] == 'index'){		
			//Do not attemt to output title if in index	
		} else {
			echo ' | '.$contents[0]['Content']['title'];
		}

	}	
} else {
	echo "You are here: Home";
}

?>