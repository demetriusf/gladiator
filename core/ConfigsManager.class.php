<?php 

namespace gladiator\core;

use gladiator\core\Config;

class ConfigsManager{

	private $configs;

	public function __construct(){

	}

    public function getConfig($configName){

        foreach( $this -> configs as  $config ){
                
            if( $config -> getName() == $configName ){

                return $config;

            }

        }

        return NULL;

    }

    public function setConfig( Config $config ){

        $this -> configs[] = $config;

    }

}