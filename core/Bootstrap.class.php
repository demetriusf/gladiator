<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Bootstrap{
	
	private function __construct(){}
	
	public static function init( System $system ){
		
		// init server's configs
		Bootstrap::initServerConfigs();

		// init auto load
		Bootstrap::initAutoLoad();

		// load system configs
		Bootstrap::loadSystemConfigs($system);		

		
	}
	
	private static function initServerConfigs(){

		@set_time_limit(30);
		@error_reporting(0);
		@set_error_handler(array('Bootstrap', 'loadErrorHandler'));
		
	}

	private static function loadSystemConfigs( System $system ){
		
		require_once (CONFIG_PATH.'config.php');
				
		$system -> setConfigsManager( new ConfigsManager( $config ) );

	}
	
	private static function initAutoLoad(){
				
		echo "Inicializa auto load <br>";		
		
	}
	
	public static function loadErrorHandler( $number, $message, $file, $line ){
		
		echo "Erro: ".$message."<br>";
		
		return TRUE; // O erro NÃO é tratado de forma normal pelo php
		
	}
		
}

?>