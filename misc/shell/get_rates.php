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
	
	SocketMemcached::create()->mark(DOMAIN)->clean();

	$rates = array();
	if (!($rates = SocketMemcached::create()->mark(DOMAIN)->get('rates'))) {
		$supported = array('USD', 'RUB', 'GBP', 'CNY');

		GlobalVar::me()->import('CurrencyFetcher');
		if ($rates = CurrencyFetcher::create()->getRates()) {
			$rates = array_intersect_key($rates, array_flip($supported));
			$rates['EUR'] = 1;
			SocketMemcached::create()->mark(DOMAIN)->set('rates', $rates);
		}
	}

	print_r($rates);
