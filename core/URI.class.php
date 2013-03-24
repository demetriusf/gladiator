<?php if( !defined('CORE_PATH') ){  die('No direct script access allowed'); }

final class URI{

    private static $instance = NULL;
    private $uri;

    CONST INDEX_OF_CONTROLLER = 1;
    CONST INDEX_OF_METHOD = 2;
    CONST INDEX_BEGIN_METHOD_PARAM = 3;

    private function __construct(){}

    private function __clone(){

    }

    public function __toString(){

        return sprintf('');

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

            throw new InvalidArgumentException('The parameter $segmentIndex must be greater than 0');

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

    public function getSegments(){

        return explode('/', $this -> getUri() );

    }

    public function getControllerSegment(){

        return $this -> getSegment(self::INDEX_OF_CONTROLLER);

    }

    public function getMethodSegment(){

        return $this -> getSegment(self::INDEX_OF_METHOD);

    }

    public function getMethodParams(){

        return array_slice( $this -> getSegments() , $this -> getRealSegmentIndex(self::INDEX_BEGIN_METHOD_PARAM) );

    }

}