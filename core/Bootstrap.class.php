<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Bootstrap{
	
	private function __construct(){}
	
	public static function init( System $system ){
		
		// init global's configs
		Bootstrap::initGlobalConfigs();

		// init auto load
		Bootstrap::initAutoLoad();

		// load system configs
		Bootstrap::loadSystemConfigs($system);		
		
		// load log system
		Bootstrap::loadLogger($system);

		// load Output
		Bootstrap::loadOutput($system);
	}
	
	private static function initGlobalConfigs(){

		@set_time_limit(30);
		@error_reporting(0);
		@set_error_handler( array('Error', 'myErrorHandler') );
		@set_exception_handler( array('Error', 'myExceptionHandler') );
		@register_shutdown_function( array('Error', 'myShutdownFunction') );
		
	}
	
	private static function initAutoLoad(){

	}	

	private static function loadSystemConfigs( System $system ){
		
		require_once(CONFIG_PATH.'config.php');
				
		$system -> setConfigsManager( new ConfigsManager( $config ) );

	}

	private static function loadLogger( System $system ){
				
		$system -> setLogger( Logger::getInstance() );

	}


	private static function loadOutput( System $system ){

		$system -> setOutput( new Output() );

	}
		
}

?>