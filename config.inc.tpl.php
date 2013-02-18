<?php
	// copy this file to 'config.inc.php' for local customization

	// system settings
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', 1);

//	setlocale(LC_CTYPE, "ru_RU.UTF8");
//	setlocale(LC_TIME, "ru_RU.UTF8");
	setlocale(LC_CTYPE, "en_EN.UTF8");
	setlocale(LC_TIME, "en_EN.UTF8");

	define('DS', DIRECTORY_SEPARATOR);
	define('PS', PATH_SEPARATOR);

	defined('MODE') || define('MODE', 'user');
	defined('PATH_SOURCE_DIR') || define('PATH_SOURCE_DIR', MODE.DS);

	if (isset($_SERVER['HTTP_HOST']))
		define('DOMAIN', $_SERVER['HTTP_HOST']);
	else
		define('DOMAIN', 'real-estate.com.cy');

	define('COOKIE_DOMAIN', '.'.DOMAIN);

	// paths
	define('PATH_BASE', dirname(__FILE__).DS);
	define('PATH_SOURCE', PATH_BASE.'src'.DS.PATH_SOURCE_DIR);
	define('TEMP_PATH', PATH_BASE.'..'.DS.'tmp'.DS);
	define('PATH_UPLOAD', TEMP_PATH.'uploads'.DS);
	define('LOGS_PATH', PATH_BASE.'..'.DS.'logs'.DS);
	define('PATH_WEBROOT', PATH_SOURCE.'webroot'.DS);
	define('PATH_IMG', PATH_WEBROOT.'img'.DS);
	define('PATH_JS', PATH_WEBROOT.'js'.DS);
	define('PATH_CSS', PATH_WEBROOT.'css'.DS);
	define('PATH_PIX', PATH_WEBROOT.'pix'.DS);
        
	// web path
	define('PATH_WEB', 'http://'.DOMAIN.'/');
	define('PATH_WEB_ADMIN', 'http://admin.'.DOMAIN.'/');
	define('PATH_WEB_PIX', '/pix/'); // dynamic stuff
	define('PATH_WEB_IMG', '/img/'); // static stuff
	define('PATH_WEB_JS', '/js/'); // static stuff
	define('PATH_WEB_CSS', '/css/'); // static stuff

	// shared classes
	define('PATH_CLASSES', PATH_BASE.'src'.DS.'classes'.DS);
	define('PATH_CONTROLLERS', PATH_SOURCE.'controllers'.DS);
	define('PATH_TEMPLATES', PATH_SOURCE.'views'.DS);
        
	// onPHP init
	define('ONPHP_TEMP_PATH', TEMP_PATH.'onphp'.DS);
	require PATH_BASE.'../onphp/global.inc.php.tpl';

	// everything else
	define('DEFAULT_ENCODING', 'UTF-8');
	mb_internal_encoding(DEFAULT_ENCODING);
	mb_regex_encoding(DEFAULT_ENCODING);
	ini_set('upload_tmp_dir', PATH_UPLOAD);
	ini_set('session.save_path', TEMP_PATH.'sessions'.DS);

	define('DEFAULT_AREA', 'main');
	define('DEFAULT_EMAIL', 'meincyp+test@gmail.com');

	define('PROJECT_NAME', 'real-estate.com.cy');

	DBPool::me()->setDefault(
		DB::spawn('PgSQL', 'htonus', '', 'localhost', 're_com_cy')->
		setEncoding(DEFAULT_ENCODING)
	);
	
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

			PATH_CLASSES.'Auto'.DS.'Business',
			PATH_CLASSES.'Auto'.DS.'Proto',
			PATH_CLASSES.'Auto'.DS.'DAOs',
		));
	
	// magic_quotes_gpc must be off

	define('__LOCAL_DEBUG__', true);
	define('BUGLOVERS', 'some.box@host.domain');
	
	
	// Extra consts
	define('EXT_TMPL', '.tpl.php');
	
//	Cache::setPeer(
//		Memcached::create()
//	);
//
//	Cache::setDefaultWorker('SmartDaoWorker');