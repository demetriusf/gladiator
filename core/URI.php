<?php 

namespace gladiator\core;

final class URI{

    private static $instance = NULL;
    private $uri;

    private function __construct(){}

    private function __clone(){

    }

    public function __toString(){

        return sprintf($this -> uri);

    }

    public static function getInstance(){

        if( is_null(self::$instance) ){

            self::$instance = new self();

        }

        return self::$instance;

    }

    public function init(){

        $this -> extractURI();

    }

    private function extractURI(){

        $tempURI = $_SERVER['REQUEST_URI'];

        if( strpos( $tempURI, $_SERVER['SCRIPT_NAME'] ) === 0 ){

            $this -> uri = substr( $tempURI, strlen($_SERVER['SCRIPT_NAME']) );

        }else if( strpos( $tempURI, dirname( $_SERVER['SCRIPT_NAME'] ) ) === 0 ){

            $this -> uri = substr( $tempURI, strlen( dirname( $_SERVER['SCRIPT_NAME'] ) ) );

        }

        $this -> setUri( $this -> uri );

    }

    private function getRealSegmentIndex( $segmentIndex ){

        if( $segmentIndex <= 0 ){

            throw new \InvalidArgumentException('The parameter $segmentIndex must be greater than 0');

        }

        return (int) ($segmentIndex - 1);

    }

    public function getUri(){

        return $this -> uri;

    }

    public function setUri( $uri ){

        $this -> uri = trim($uri, '/');

    }

    public function getSegment( $segmentNumber ){

        $segmentNumber = $this -> getRealSegmentIndex($segmentNumber);

        $segments = $this -> getSegments();

        if( isset( $segments[$segmentNumber] ) ){

            return $segments[$segmentNumber];

        }

        return FALSE;

    }

    public function getSegments( $offset = NULL, $length = NULL ){

    	$uri = $this -> getUri();
    	
    	if( !empty( $uri ) ){
    		
    		$segments = explode('/', $uri );
    		
   			if( $offset !== NULL ){ // return a piece
   				
   				if( $length !== NULL )
					return array_slice($segments, $offset, $length);	
   				else
   					return array_slice($segments, $offset);
   				
   			}else{
   				
   				return $segments;
   				
   			}	
    		
    	}
    	    	
        return array() ;

    }

}