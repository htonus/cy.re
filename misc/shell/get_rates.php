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
	if (!($res = Cache::me()->mark('cyprus-realty.com')->get('rates'))) {
//		GlobalVar::me()->import('CurrencyFetcher');
//		$rates = CurrencyFetcher::create()->getRates();
//		Cache::me()->mark('cyprus-realty.com')->set('rates', $rates);
	}

	print_r($res);

//	$m = new Memcached();
//	$m->setOption(Memcached::OPT_PREFIX_KEY, 'aaa');
//	$m->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE, true);
//	$m->addServer('localhost', 11211);
//	$m->add('aaa', 12345);
//	print_r($m->getAllKeys());
//	$res = $mc->connect('localhost', 11211);
//	var_dump($res);

//	$m->set('qaz', 12345);
//	$m->flush();
//	print_r($m->get('aaa'));
