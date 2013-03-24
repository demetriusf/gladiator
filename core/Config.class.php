<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Config{

    private $name;
    private $value;

    public function __construct(){

    }

    public function getName(){

        return $this -> name;

    }

    public function setName( $name ){

        $this -> name = $name;

    }

    public function getValue(){

        return $this -> name;

    }

    public function setValue( $value ){

        $this -> value = $value;

    }

}