<?php

require_once 'PHPUnit2/Framework/TestCase.php';
require_once 'PHPUnit2/Framework/Assert.php';

class Classe2Test extends PHPUnit_Framework_TestCase {

  public function testCumprimentarSemParametro() {

    $this->assertEquals('Olá fulano', 'Olá fulano' );
  }

}