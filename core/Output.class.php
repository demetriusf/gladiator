<?php if( !defined('CORE_PATH') ){ die('No direct script access allowed'); }

class Output{

    private $errorOutput;
    private $output;

    public function __construct(){}

    public function append( $val ){

        $this -> output .= $val;

    }

    public function appendErrorOutput( $val ){

        if(!empty($val))
            $this -> errorOutput .= $val;
        else
            throw new InvalidArgumentException("The error input must not be empty");

    }

    public function __toString(){

        return sprintf('%s %s'  , $this -> errorOutput, $this -> output);

    }

}