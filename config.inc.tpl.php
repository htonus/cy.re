<?php
	// copy this file to 'config.inc.php' for local customization

	define('PROJECT_NAME', 'real-estate.com.cy');
	
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
		define('DOMAIN', preg_replace('/(admin|www)\./i', '', $_SERVER['HTTP_HOST']));
	else
		define('DOMAIN', 'cyprus-realty.com');

	require_once 'definitions.inc.php';
	
	mb_internal_encoding(DEFAULT_ENCODING);
	mb_regex_encoding(DEFAULT_ENCODING);
	ini_set('upload_tmp_dir', PATH_UPLOAD);
	ini_set('session.save_path', TEMP_PATH.'sessions');
	session_set_cookie_params(3600, '/', COOKIE_DOMAIN, false, true);

	DBPool::me()->setDefault(
		DB::spawn('PgSQL', 'crcom', 'sohK2uuw', 'localhost', 'cr_com')->
		setEncoding(DEFAULT_ENCODING)
	);
	
	GlobalVar::me()->
		set(
			'language',
			Language::dao()->getByCode(DEFAULT_LANG_CODE)
		);

//	Cache::setPeer(
//		Memcached::create()
//	);
//
//	Cache::setDefaultWorker('SmartDaoWorker');

	// Custom Stuff
	Logger::me(array(
		'default'	=> array(
			'buglovers'	=> BUGLOVERS,
			'logfolder'	=> PATH_LOG,
			'level'		=> Logger::ERROR,
			'append'	=> array(Logger::DEBUG => Logger::A_FILE, Logger::A_FILE, Logger::A_FILE, Logger::A_FILE, Logger::A_FILE),
			'prefix'	=> MODE,
			'period'	=> Logger::P_DAY
		),
	));
