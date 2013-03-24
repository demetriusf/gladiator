<?php if( !defined('CORE_PATH') ){  die('No direct script access allowed'); }

/*

    URI só tem o controlador
    URI tem controlador e método
    URI tem controlador, método e 1 parametro
    URI tem controlador, método, e N parametros
    URI não tem controlador

    ORIGEM:                                         DESTINO:
            post/(.*)/(.*)                                  blog/post/$1/$2
            administracao/posts                             administracao_posts
            administracao/posts/editar/exec/(:num)          administracao_posts/editarAction/$1

*/

final class URI{

    private static $instance = NULL;
    private static $configManager = NULL;
    private $uri;
    private $controllerSegment;
    private $modelSegment;
    private $methodSegment;

    private function __construct(){}
                                        
    public static function getInstance( ConfigsManager $configManager ){

        if( is_null(self::$instance) ){

            self::$instance = new self();
            self::$configManager = $configManager;
            $urlTemp = 'http://localhost:8080/gladiator/';
            $uriTemp = 'http://localhost:8080/'.$_SERVER['REQUEST_URI'];
            //echo strstr($uriTemp, $urlTemp) ;

        }

        return self::$instance;

    }

    public function getUri(){
        echo self::$configManager -> site_url;
        return $this -> uri;

    }

    public function getSegment( $segmentNumber ){



    }

    public function getSegments(){



    }

    public function getControllerSegment(){



    }

    public function getModelSegment(){



    }

    public function getMethodSegment(){



    }

}