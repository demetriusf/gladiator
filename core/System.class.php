<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class System{
	
	private static $instance = NULL;
	private $configsManager;
	CONST SYSTEM_VERSION = 'Gladiator 1.0';
	
	private function __construct(){}
	
	public static function getInstance(){
		
		if( is_null(System::$instance) ){

			System::$instance = new self();
			
		}				
		
		return System::$instance;
		
	}
	
	public function init(){
		
		Bootstrap::init( $this );
		
	}
	
	public function getConfigsManager(){
		
		return $this -> configsManager;
		
	}
	
	public function setConfigsManager( ConfigsManager $configsManager ){
		
		$this -> configsManager = $configsManager;
		
	}

}