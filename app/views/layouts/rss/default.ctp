<?php
echo $rss->header();
$channel = $rss->channel(array(), $channelData, $rss_data);
echo $rss->document(array(), $channel);

?>