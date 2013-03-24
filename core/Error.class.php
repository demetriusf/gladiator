<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Error{

	public static function myErrorHandler( $number, $message, $file, $line ){

		$logger = Logger::getInstance();

        $system = System::getInstance();

        $notExistsOutput = is_null($system -> getOutput());

		$messageLog = sprintf("%s \t File: %s \t Line: %d", $message, $file, $line);
        $levelMode = "";

		switch( $number ){

			case E_USER_ERROR:  /*The script will stop*/
			case E_ERROR:
								$logger->e($messageLog);
								$logger->saveLogsInFile();
                                $levelMode = "Error";

                                $phpError = Error::getPhpError($levelMode, $message, $file, $line);

                                if( $notExistsOutput ){

                                    echo $phpError;

                                }else{

                                    $system -> getOutput() -> appendErrorOutput($phpError);

                                    die($system -> getOutput());

                                }

			case E_USER_WARNING:
			case E_WARNING:
								$logger->w($messageLog);
                                $levelMode = "Warning";

                                $phpError = Error::getPhpError($levelMode, $message, $file, $line);

                                if( $notExistsOutput ){

                                    echo $phpError;

                                }else{

                                    $system -> getOutput() -> appendErrorOutput($phpError);

                                }

								break;

			case E_USER_NOTICE:
			case E_NOTICE:
								$logger->i($messageLog);
                                $levelMode = "Info";

                                $phpError = Error::getPhpError($levelMode, $message, $file, $line);

                                if( $notExistsOutput ){

                                    echo $phpError;

                                }else{

                                    $system -> getOutput() -> appendErrorOutput($phpError);

                                }

								break;

			default:
                                $levelMode = $number;
								$logger->custom( $number, $messageLog);

                                $phpError = Error::getPhpError($levelMode, $message, $file, $line);

                                if( $notExistsOutput ){

                                    echo $phpError;

                                }else{

                                    $system -> getOutput() -> appendErrorOutput($phpError);

                                }
			
			
		}

		return TRUE; // the php doesn't treat this error when the return is TRUE
		
	}

	public static function myExceptionHandler( $exception ){ /*The script will stop*/

        $levelMode = "Exception";
        $message = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();

		$messageLog = sprintf("%s \t File: %s \t Line: %d", $message, $file, $line);

		$logger = Logger::getInstance();
        $logger->custom(ucwords($levelMode), $messageLog);
        $logger -> saveLogsInFile();

        $system = System::getInstance();
        $notExistsOutput = is_null( $system -> getOutput());

        $phpError = Error::getPhpError($levelMode, $message, $file, $line);

        if( $notExistsOutput ){

            echo $phpError;

        }else{

          $system -> getOutput() -> appendErrorOutput($phpError);

          die($system -> getOutput());

        }

	}

	public static function myShutdownFunction(){
        //Quando uma funcao ou um require lanca um fatal error, vem para essa funcao. Porem o erro ja foi lançado e nao ha nada que se possa fazer, a nao ser mostrar algo na tela.
        $error = error_get_last();

        $levelMode = "Shutdown";
        $message = $error['message'];
        $file = $error['file'];
        $line = $error['line'];


	}

    public static function showError404(){

        header("Status: 404 Not Found", FALSE, 404);
        require_once(ERRORS_PATH.'404.php');
        exit();

    }

    public static function getPhpError($level, $message, $file, $line){

      $output = "";

      ob_start();
      require(ERRORS_PATH.'php_error.php');
      $output = ob_get_contents();
      ob_end_clean();


      return $output;

    }

}