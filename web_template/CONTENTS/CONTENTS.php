<?php 
	$pageContentName = $pageName.".html";
	$webpagedirectory = "CONTENTS/CONTENTPAGES/".$pageName."/";
	$webpage = $webpagedirectory.$pageContentName;
	if (file_exists($webpage))
	{
		include($webpage);
	}
	else
	{
		include($webpagedirectory."default.html");
	}
?>