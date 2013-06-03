<?php 
namespace gladiator\core;

use gladiator\core\Log;

final class Logger{

    private static $instance = NULL;
	private $logs = array();
	
	private function __construct(){}

    private function __clone(){


    }
    
    public function __toString(){

        return sprintf('');

    }

    public static function getInstance(){

        if( is_null(Logger::$instance) ){

			Logger::$instance = new self();

		}

		return Logger::$instance;

    }
	
	private function createLog( $logType, $message ){
		
		$log = new Log( $logType, date('Y-m-d h:i:s'), $message);
		
		$this -> logs[] = $log;

	}
	
	public function getLogsToString(){

		return implode('<br />', $this -> logs);

	}
	
	public function saveLogsInFile( $filePath="" ){
			
			$accessSafe = "<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); } ?>";
			$logText = implode(chr(13), $this -> logs);

			if( !empty( $logText ) ){

				$logText = chr(13).$logText;

				if( empty( $filePath ) ){
				
					$filePath = "logs/log-".date('Y-m-d').".php";	
				
				}

				if( !file_exists( $filePath ) ){

					$logText = $accessSafe.$logText;
					
				}
				
				$fp = fopen($filePath, 'a');
				
				if( $fp ){
				
					fwrite($fp, $logText);
					fclose($fp);
				
				}else{
					
					throw new \RuntimeException( "It was not possible save the Log in the following file: $filePath " );

				}

				
			}	

	}
	
	public function clear(){
		
		$this->logs = array();
		
	}

	public function d( $message ){
		
		$this -> createLog("DEBUG", $message);
		
	}
	
	public function i( $message ){
		
		$this -> createLog("INFO", $message);
		
	}
	
	public function w( $message ){
		
		$this -> createLog("WARNING", $message);
		
	}

	public function e( $message ){
		
		$this -> createLog("ERROR", $message);
		
	}

	public function custom( $errorLevel, $message ){
		
		$this -> createLog($errorLevel, $message);
		
	}

}