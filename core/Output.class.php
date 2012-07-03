<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Output{

    private $output;

    public function __construct(){}

    public function prepend( $val ){

        $this -> output = $val.$this -> output;

    }

    public function append( $val ){

        $this -> output .= $val;

    }

    public function printOutput(){

        echo $this -> output;

    }

}