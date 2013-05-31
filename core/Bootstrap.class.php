<?php 

namespace gladiator\core;

use gladiator\core\System;
use gladiator\core\Error;
use gladiator\core\ConfigsManager;
use gladiator\core\Config;
use gladiator\core\Logger;
use gladiator\core\Output;
use gladiator\core\URI;

class Bootstrap{
	
	private function __construct(){}
	
	public static function init( System $system ){
		
		// init global's configs
		Bootstrap::initGlobalConfigs();

		// load system configs
		Bootstrap::loadSystemConfigs($system);		
		
		// load log system
		Bootstrap::loadLogger($system);

		// load Output
		Bootstrap::loadOutput($system);

		// load URI
		Bootstrap::loadURI($system);
	}
	
	private static function initGlobalConfigs(){

		@set_time_limit(30);
		@error_reporting(E_ALL);
		@set_error_handler( array(new Error(), 'myErrorHandler') );
		@set_exception_handler( array(new Error(), 'myExceptionHandler') );
		@register_shutdown_function( array(new Error(), 'myShutdownFunction') );
		
	}

	private static function loadSystemConfigs( System $system ){
		
		require_once(CONFIG_PATH.'config.php');

        $configManager = new ConfigsManager();

        //Might create a Factory to config is good.
        foreach( $config as $configName => $configValue ){
                             
            $configTemp = new Config();
            $configTemp -> setName($configName);
            $configTemp -> setValue($configValue);

            $configManager->setConfig($configTemp);

        }

        $system -> setConfigsManager( $configManager );

	}

	private static function loadLogger( System $system ){
				
		$system -> setLogger( Logger::getInstance() );

	}


	private static function loadOutput( System $system ){

		$system -> setOutput( new Output() );

	}

    private static function loadURI( System $system ){

        $uri = URI::getInstance();
        $uri -> init();  // the same idea that a normal constructor

        $system -> setURI( $uri );

    }
		
}

?>