<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

	define('MODE', 'user');

	$appPath = realpath(dirname(dirname(dirname(__FILE__))))
		.DIRECTORY_SEPARATOR;

	if (file_exists($appPath.'config.inc.php'))
		require_once ($appPath.'config.inc.php');
	else
		require_once ($appPath.'config.inc.tpl.php');
	
//	Cache::me()->mark('cyprus-realty.com')->clean();

	$res = array();
	if (!($res = SocketMemcached::create()->mark('cyprus-realty.com')->get('rates'))) {
		GlobalVar::me()->import('CurrencyFetcher');
		$rates = CurrencyFetcher::create()->getRates();
		SocketMemcached::create()->mark('cyprus-realty.com')->set('rates', $rates);
	}

	print_r($res);
