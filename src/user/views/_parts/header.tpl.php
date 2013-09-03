<?php
/*
 * $Id$
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Generic </title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="content-language" content="<?= $language->getCode()?>">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="revisit-after" content="1 days">

	<meta name="description" content="">
	<meta name="keywords" content="авто, аботы, конку, афта, душу, текст, ытый, мудаг, гогно, Уважайте, вопль, евас, теме, житесь, возде, пРоШУ, непот, ебных, лучше, ажений, голосования, стену, деТи, еативов, отких, евод, победителя, защищены, ские, уппу, Тема, напоминаю, плюнуть, оЧенЬ">
	<meta name="robots" content="index,follow">
	<meta name="Author" content="htonus">
	<meta name="Organization" content="hTonus labs">
	<meta name="copyright" content="2013 (с) cyprus-realty.com">
	<meta name="document-state" content="dynamic">
	<meta name="revisit-after" content="1 days">
	<link rel="apple-touch-icon" href="<?=PATH_WEB?>html/indexyap.png" />
	<link rel="alternate" type="application/rss+xml" title="Website News" href="<?=PATH_WEB?>/rss/news.xml" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

<?php
	$html->css('bootstrap.min');
	$html->css('bootstrap-responsive.min');
	$html->css('main');
	$html->js('jquery-1.9.1.min');
	$html->js('bootstrap.min');
	$html->js('main.min');
	
	$html->jsRaw('
		jq = jQuery.noConflict();
	');
?>

<body>
