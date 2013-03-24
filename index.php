<?php
//*********************************//
// ** Initialize the constants  ** //
//*********************************//
define('CORE_PATH', 'core/');
define('CONFIG_PATH', 'config/');
define('ERRORS_PATH', 'errors/');

//*********************************//
// **** Initialize the system **** //
//*********************************//
require_once(CORE_PATH.'System.class.php');
require_once(CORE_PATH.'Bootstrap.class.php');
require_once(CORE_PATH.'Error.class.php');
require_once(CORE_PATH.'ConfigsManager.class.php');
require_once(CORE_PATH.'Logger.class.php');
require_once(CORE_PATH.'Log.class.php');
require_once(CORE_PATH.'Output.class.php');
require_once(CORE_PATH.'URI.class.php');
require_once(CORE_PATH.'Config.class.php');

$system = System::getInstance();
$system -> init();
//*********************************//
// ****   Call the plugins    **** //
//*********************************//

//*******************************//
// ****   Call the request  **** //
//*******************************//
//$system -> executeRequest();

//*******************************//
// ***** Print the output  ***** //
//*******************************//
echo $system -> getOutput();

//********************************************************//
// **** If any error was threw, save the log in file **** //
//********************************************************//
$system->getLogger()->saveLogsInFile();