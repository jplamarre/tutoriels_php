<?php

use Core\Config\Config;
use Core\Database\MySqlDatabase;

class App{

	public static $title = 'Mon super site';
	private static $_instance;
	private static $db_instance;

	public function __construct(){
	
	}

	public static function getInstance(){
		if(is_null(self::$_instance)){
			self::$_instance = new App();
		}
		return self::$_instance;
	}

	public static function load() {
		session_start();
		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT . '/Core/Autoloader.php';
		Core\Autoloader::register();
	}

	public function getTable($name) {
		$class_name = 'App\\Table\\' .ucfirst($name) . 'Table';
		return new $class_name($this->getDb());
	}

	public function getDb(){
		if (is_null(self::$db_instance)){
			$config = Config::getInstance(ROOT . '/config/config.php');
			self::$db_instance = new MySqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return self::$db_instance;
	}



}
?>
