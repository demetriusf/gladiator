<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Error{
	// {data} - [ERROR - $number] --->  $message
	public static function myErrorHandler( $number, $message, $file, $line ){

		Error::createAndSaveLog();
		
		return TRUE; // the php doesn't treat this error when the return is like TRUE
		
	}
	
	public static function myExceptionHandler( $exception ){ // Se a exception não for tratada pelo catch sempre cairá aqui.
		
		echo "Exception: ".$exception->getMessage()."<br>";
				
	}
	
	public static function myShutdownFunction(){ // Se o error for mais sério ou alguém deu um exit() será pego aqui e gerado um log.
		
		$erros = error_get_last();
		
	}	
	
	private static function createAndSaveLog(){
		
		global $system;
		
		if( is_object($system) ){
				
			$logger = $system -> getLogger();
			
			if( is_object($logger) ){
				
				$logger -> custom('Error', 'Magavilha');			
				$logger -> saveLogsInFile();
				
			}
			
		}
		
	} 

}