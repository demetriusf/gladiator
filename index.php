<?php
//*********************************//
// ** Initialize the constants  ** //
//*********************************//
define('CORE_PATH', 'core/');
define('CONFIG_PATH', 'config/');
define('CONTROLLERS_PATH', 'controllers/');
define('ERRORS_PATH', 'errors/');

//*********************************//
// **** Initialize the system **** //
//*********************************//
require_once(CORE_PATH.'System.php');
require_once(CORE_PATH.'Bootstrap.php');
require_once(CORE_PATH.'Error.php');
require_once(CORE_PATH.'ConfigsManager.php');
require_once(CORE_PATH.'Logger.php');
require_once(CORE_PATH.'Log.php');
require_once(CORE_PATH.'Output.php');
require_once(CORE_PATH.'URI.php');

use gladiator\core\System;

$system = System::getInstance();

//*********************************//
// ****   Call the plugins    **** //
//*********************************//


//*******************************//
// ****   Call the request  **** //
//*******************************//
$system -> executeRequest();

//*******************************//
// ***** Print the output  ***** //
//*******************************//
echo $system -> getOutput();

//********************************************************//
// **** If any error was threw, save the log in file **** //
//********************************************************//
if( $system -> getConfigsManager() -> getConfig( 'automatic_save' ) ){
	
	$system->getLogger()->saveLogsInFile();	
	
}