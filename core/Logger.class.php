<?php
class Logger{
	
	private $logs = array();
	
	CONST LOG_OUTPUT_SCREEN = 1;
	CONST LOG_OUTPUT_FILE = 2;
	CONST LOG_OUTPUT_SCREEN_FILE= 3;
	
	public function __construct(){}
		
	private function getModeLogOutput( $modeLogOutput ){
		
		$modeLogOutput = (int) $modeLogOutput;

		return $modeLogOutput < 1 || $modeLogOutput > 4 ? 1 : $modeLogOutput;
		
	}
	
	private function createLog( $logType, $message, $modeLogOutput ){
		
		$modeLogOutput = $this -> getModeLogOutput($modeLogOutput);
		
		$log = new Log( $logType, date('d/m/Y h:i:s'), $message);
		
		if( $modeLogOutput === Logger::LOG_OUTPUT_SCREEN_FILE ){

			$this -> logs[Logger::LOG_OUTPUT_SCREEN][] = $log;
			$this -> logs[Logger::LOG_OUTPUT_FILE][] = $log;
			
		}else{
			
			$this -> logs[$modeLogOutput][] = $log;
			
		}
				
		
	}
	
	public function getLogsOutputScreen(){
		
		if( isset($this -> logs[Logger::LOG_OUTPUT_SCREEN]) ){
			
			return implode('<br />', $this -> logs[Logger::LOG_OUTPUT_SCREEN]);
			
		}
		
	}
	
	public function saveLogsInFile( $filePath ){
		
		if( isset($this -> logs[Logger::LOG_OUTPUT_FILE]) ){
			
			$logText = implode('\n\r', $this -> logs[Logger::LOG_OUTPUT_FILE])."\n\r";
			
			if( !empty( $logText ) ){
				
				$fp = fopen('test.php', 'a+');
				fwrite($fp, $logInText);
				fclose($fp);
				
			}	
			
		}		
		
	}
	
	public function clear(){
		
		$this->logs = array();
		
	}

	public function d( $message, $modeLogOutput = 1 ){
		
		$this -> createLog("DEBUG", $message, $modeLogOutput);
		
	}
	
	public function i( $message, $modeLogOutput = 1 ){
		
		$this -> createLog("INFO", $message, $modeLogOutput);
		
	}
	
	public function w( $message, $modeLogOutput = 1 ){
		
		$this -> createLog("WARNING", $message, $modeLogOutput);
		
	}

	public function e( $message, $modeLogOutput = 1 ){
		
		$this -> createLog("ERROR", $message, $modeLogOutput);
		
	}

}