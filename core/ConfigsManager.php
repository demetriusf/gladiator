<?php 

namespace gladiator\core;

class ConfigsManager{

	private $configs = array();

	public function __construct(){

	}

    public function getConfig( $name ){

        foreach( $this -> configs as  $configName => $configValue ){
                
            if( $configName == $name ){

                return $configValue;

            }

        }

        return NULL;

    }

    public function setConfigs( $configs ){

        $this -> configs = $configs;

    }
    
    public function addConfigs( $configs ){
    
    	$this -> configs = array_merge( $this -> configs, $configs );
    
    }

}