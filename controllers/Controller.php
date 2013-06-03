<?php

class Controller {

	public function __construct() {

	}
	
	public function index(  ){

			echo 'index';
		
	}
	
	public function nome($name, $sobrenome, $ultimoNome=" null"){
		
		echo "$name $sobrenome $ultimoNome";
				
	}
	
}

?>