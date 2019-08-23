<?php

class LoginData {
	// user attributes
	private $Email, $Password;
	
	// static function to get user instance
	public static function createInstance(){
		return new LoginData("","");
	}

	// constructor to capture public Login Data attributes
	function __construct($Email, $Password)
	{
		$this->Password = $Password;
		$this->Email = $Email;
	}
  
	// getters
	public function getPassword() {
		return $this->Password;
	}

	public function getEmail() {
		return $this->Email;
	}
	
	
	// setters
	function setPassword($password) {
		$this->Password = $password;
    }
    function setEmail($email) {
		$this->Email = $email;
	}

	

	
 
}