<?php 
namespace gladiator\core;

use gladiator\core\Bootstrap;
use gladiator\core\ConfigsManager;
use gladiator\core\Logger;
use gladiator\core\Output;
use gladiator\core\URI;

final class System{
	
	private static $instance = NULL;
	private $configsManager = NULL;
	private $logger = NULL;
    private $output = NULL;
    private $uri = NULL;
	CONST SYSTEM_VERSION = 'Gladiator 1.0';
	
	private function __construct(){}

    private function __clone(){
      
    }

    public function __toString(){

        return sprintf('');

    }
	
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
	
	public function getLogger(){
		
		return $this -> logger;
		
	}
	
	public function setLogger( Logger $logger ){
		
		$this -> logger = $logger;
		
	}

    public function getOutput(){

        return $this -> output;

    }

    public function setOutput( Output $output ){

        $this -> output = $output;

    }

    public function getURI(){

        return $this -> uri;

    }

    public function setURI(URI $uri){

        $this -> uri = $uri;

    }

}