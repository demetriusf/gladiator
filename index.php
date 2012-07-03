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

$system = System::getInstance();
$system -> init();

$system -> getOutput() -> append('Aqui estarei adicionando uma saida para o sistema...');
file_get_contents('AUHauAH');
$system -> getOutput() -> printOutput();
//********************************************************//
// **** If any error was threw, save the log in file **** //
//********************************************************//
$system->getLogger()->saveLogsInFile();