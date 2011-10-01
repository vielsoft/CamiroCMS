<?php
if(isset($contents)){
	$siteName = $contents[0]['Content']['title'].' - '.$camiroConfig['SiteName'];
	$siteDescription = $contents[0]['Content']['metadesc'].' , '.$camiroConfig['SiteDescription'];
	$siteKeywords = $contents[0]['Content']['metakey'].' , '.$camiroConfig['SiteKeywords'];
} else {
	$siteName = $camiroConfig['SiteName'];
	$siteDescription = $camiroConfig['SiteDescription'];
	$siteKeywords = $camiroConfig['SiteKeywords'];
}

?>
<title><?php echo $siteName; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?php echo $siteDescription; ?>" />
<meta name="keywords" content="<?php echo $siteKeywords; ?>" />

