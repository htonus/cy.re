<?php

	// web path
	define('COOKIE_DOMAIN', '.'.DOMAIN);
	define('PATH_WEB', 'http://'.(MODE == 'user' ? 'www.' : 'admin.').DOMAIN.'/');
	define('PATH_WEB_ADMIN', 'http://admin.'.DOMAIN.'/');
	define('PATH_WEB_USER', 'http://www.'.DOMAIN.'/');

	define('PATH_WEB_PIX', PATH_WEB_USER.'pix/'); // static stuff
	define('PATH_WEB_IMG', PATH_WEB.'img/'); // dinamic stuff
	define('PATH_WEB_JS', PATH_WEB.'js/'); // dinamic stuff
	define('PATH_WEB_CSS', PATH_WEB.'css/'); // dinamic stuff

	// paths
	define('PATH_BASE', dirname(__FILE__).DS);
	define('PATH_SOURCE', PATH_BASE.'src'.DS.PATH_SOURCE_DIR);
	define('TEMP_PATH', PATH_BASE.'..'.DS.'tmp'.DS);
	define('PATH_UPLOAD', TEMP_PATH.'uploads'.DS);
	define('PATH_LOG', PATH_BASE.'..'.DS.'logs'.DS);
	define('PATH_WEBROOT', PATH_SOURCE.'webroot'.DS);
	define('PATH_IMG', PATH_WEBROOT.'img'.DS);
	define('PATH_JS', PATH_WEBROOT.'js'.DS);
	define('PATH_CSS', PATH_WEBROOT.'css'.DS);
	define('PATH_PIX', PATH_BASE.'src'.DS.'user'.DS.'webroot'.DS.'pix'.DS);

	// shared classes
	define('PATH_CLASSES', PATH_BASE.'src'.DS.'classes'.DS);
	define('PATH_CONTROLLERS', PATH_SOURCE.'controllers'.DS);
	define('PATH_TEMPLATES', PATH_SOURCE.'views'.DS);
	define('PATH_VENDORS', PATH_BASE.'vendors'.DS);

	define('EXT_TMPL', '.tpl.php');
	
	// onPHP init
	define('ONPHP_TEMP_PATH', TEMP_PATH.'onphp'.DS);
	require PATH_BASE.'../onphp/global.inc.php.tpl';

	define('BUGLOVERS', 'admin@cyprus-realty.com');
	define('DEFAULT_EMAIL', 'meincyp+test@gmail.com');

	define('DEFAULT_ENCODING', 'UTF-8');
	define('DEFAULT_LANG_CODE', 'en');

	try {
		Assert::classExists('AutoloaderPool');

		AutoloaderPool::get('onPHP')->
			addPaths(array(
				PATH_CLASSES,
				PATH_CONTROLLERS,
				PATH_CLASSES.'DAOs',
				PATH_CLASSES.'Flow',
				PATH_CLASSES.'Business',
				PATH_CLASSES.'Proto',
				PATH_CLASSES.'Helpers',
				PATH_CLASSES.'Filters',
				PATH_CLASSES.'Interfaces',

				PATH_CLASSES.'Auto'.DS.'Business',
				PATH_CLASSES.'Auto'.DS.'Proto',
				PATH_CLASSES.'Auto'.DS.'DAOs',
			));
	} catch (Exception $e) {
		set_include_path(
			get_include_path().PS
			.PATH_CLASSES.PS
			.PATH_CONTROLLERS.PS
			.PATH_CLASSES.'DAOs'.PS
			.PATH_CLASSES.'Flow'.PS
			.PATH_CLASSES.'Business'.PS
			.PATH_CLASSES.'Proto'.PS
			.PATH_CLASSES.'Helpers'.PS
			.PATH_CLASSES.'Filters'.PS
			.PATH_CLASSES.'Interfaces'.PS

			.PATH_CLASSES.'Auto'.DS.'Business'.PS
			.PATH_CLASSES.'Auto'.DS.'Proto'.PS
			.PATH_CLASSES.'Auto'.DS.'DAOs'
		);
	}

	define('GOOGLE_API_KEY', 'AIzaSyDqJzotMc4rSGxKv6JHxDK6wQYLhdJiR_Y');
//	define('RELEVANT_SEARCH', 1);