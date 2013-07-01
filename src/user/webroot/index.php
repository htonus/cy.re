<?php
	
	define('MODE', 'user');

	$appPath = realpath(dirname(dirname(dirname(dirname(__FILE__)))))
		.DIRECTORY_SEPARATOR;

	if (file_exists($appPath.'config.inc.php'))
		require_once ($appPath.'config.inc.php');
	else
		require_once ($appPath.'config.inc.tpl.php');

	try {
		if (!Session::isStarted())
			Session::start();
		
		$request = HttpRequest::create()->
			setGet($_GET)->
			setPost($_POST)->
			setServer($_SERVER)->
			setFiles($_FILES)->
			setSession($_SESSION)->
			setCookie($_COOKIE)->
			setUrl(HttpUrl::create()->parse($_SERVER['REQUEST_URI']));

		Application::create($request)->run();

	} catch (Exception $e) {
		$trace = $e->getTraceAsString();
		$extensionClass = get_class($e);

		$msg = 'Query URL: '.$_SERVER['REQUEST_URI']."\n";
		$msg .= "Exception: $extensionClass\n";
		$msg .= 'Message: '.$e->getMessage()."\n";

		if ($extensionClass == 'ClassNotFoundException') {
			$className = 'unknown';
			if (preg_match("/__autoload\(\'([^\']+)\'\)/m", $trace, $m)) {
				$className = $m[1];
			}
			$msg .= 'Class not found: ['.$className.']';
		}

		$msg .= "\nTrace:\n$trace\n";

		if (defined('DEV_MODE')) {
			echo '<pre>';
			echo $msg;
			echo '</pre>';
		} else {
			Logger::me()->error(null, $msg);
			header('Location: /');
		}
	}
