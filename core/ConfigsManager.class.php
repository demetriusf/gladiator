<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class ConfigsManager{

	private $configs;
	
	public function __construct( $configs = array() ){
		
		$this -> configs = $configs;
		
	}
	
	public function __get( $index ){
		
		if( isset($this -> configs[$index] ) ){
			
			$config = $this -> configs[$index];
			
		}else{
			
			trigger_error("The config '$index' doesn't exists", E_USER_ERROR);
			
		}
		
		return $config;
		
	}
	
	public function __set( $index, $value ){
		
		$this -> configs[$index] = $value;		
		
	}
	
	public function getConfigs(){
		
		return $this -> configs;
		
	}
	
	public function setConfigs( $configs ){
		
		$this -> configs = $configs;	
		
	}

}