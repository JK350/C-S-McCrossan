<?php 
	$folder=explode("/",$_SERVER['SCRIPT_NAME']); 
	$pageName =  $folder[sizeof($folder)-1];
	$pageName = str_replace(".php", ".html", $pageName);
	$webpagedirectory = "CONTENTS/CONTENTPAGES/";
	$webpage = $webpagedirectory.$pageName;
	if (file_exists($webpage))
	{
		include($webpage);
	}
	else
	{
		include($webpagedirectory."default.html");
	}
?>