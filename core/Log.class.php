<?php
class Log{

	private $type;
	private $date;
	private $message;
	
	public function __construct( $type, $date, $message ){
		
		$this -> type = $this -> typeValidate( $type );		
		$this -> date = $this -> dateValidate($date);
		$this -> message = $this -> messageValidate($message);
		
	}
	
	public function __toString(){
		
		return sprintf("%s - [%s] ---> \t %s ", $this -> getDate(), $this -> getType(), $this -> getMessage() );
		
	}
	
	public function getType(){
		
		return $this -> type;
		
	}
	
	public function getDate(){
		
		return $this -> date;
		
	}
	
	public function getMessage(){
		
		return $this -> message;
		
	}
	
	private function typeValidate( $type ){
		
		if( empty( $type) )
			throw new InvalidArgumentException("The type must not be empty! ");	
			
		return $type;
		
	}
	
	private function dateValidate( $date ){
		
		if( empty( $date) )
			throw new InvalidArgumentException("The date must not be empty! ");
				
		return $date ;
		
	}
	
	private function messageValidate($message){
		
		if( empty($message) )
			throw new InvalidArgumentException("The message must not be empty!");
			
		return $message;
		
	}

}