<?php
class Logger{
	
	private $modeLogOutput = 1;
	
	CONST LOG_OUTPUT_FILE = 1;
	CONST LOG_OUTPUT_SCREEN = 2;
	CONST LOG_OUTPUT_FILE_SCREEN= 3;
	CONST LOG_RETURN_OUTPUT = 4;
	
	public function __construct(){}
	
	public function getModeLogOutput(){
		
		return $this -> modeLogOutput;
		
	}
	
	public function setModeLogOutput( $modeLogOutput ){
		
		$modeLogOutput = (int) $modeLogOutput;

		$this -> modeLogOutput = $modeLogOutput < 1 || $modeLogOutput > 4 ? 1 : $modeLogOutput;
		
	}

	public function d( $message ){
		
	}
	
	public function i( $message ){
		
	}
	
	public function w( $message ){
		echo $message."<br>";	
	}

	public function e( $message ){
		
	}

}