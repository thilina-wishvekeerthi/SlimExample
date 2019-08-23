<?php

class User {
	// user attributes
	private $Id, $FullName, $Address, $Password, $Repassword, $Salt,
	 $Email, $ContactNo, $IsActive, $IsEmailVerified, $EmailToken,$IsAdmin;
	
	// static function to get user instance
	public static function createInstance(){
		return new User("","","","","","");
	}

	// constructor to capture public user attributes
	function __construct($FullName, $Address, $Password, $Repassword,
	 $Email, $ContactNo )
	{
		$this->FullName = $FullName;
		$this->Address = $Address;
		$this->Password = $Password;
		$this->Repassword = $Repassword;
		$this->Email = $Email;
		$this->ContactNo = $ContactNo;
	}
  
	// getters
	public function getId() {
		return $this->Id;
    }
    
    public function getFullName() {
		return $this->FullName;
	}

	public function getAddress() {
		return $this->Address;
	}

	public function getPassword() {
		return $this->Password;
	}

	public function getRepassword() {
		return $this->Repassword;
	}
	
	public function getEmail() {
		return $this->Email;
	}
	
	public function getContactNo() {
		return $this->ContactNo;
	}

	public function getSalt() {
		return $this->Salt;
	}

	public function getEmailToken() {
		return $this->EmailToken;
	}

	public function getIsActive() {
		return $this->IsActive;
	}

	public function getIsEmailVerified() {
		return $this->IsEmailVerified;
	}
	
	public function getIsAdmin() {
		return $this->IsAdmin;
	}

	// setters
	function setId($Id) {
		$this->Id = $Id;
    }

	function setSalt($salt) {
		$this->Salt = $salt;
    }

	function setPassword($password) {
		$this->Password = $password;
	}

	function setIsActive($active) {
		$this->IsActive = $active;
	}
	
	function setIsEmailVerified($verified) {
		$this->IsEmailVerified = $verified;
	}
	
	function setEmailTocken($token) {
		$this->EmailToken = $token;
	}

	function setIsAdmin($admin) {
		$this->IsAdmin = $admin;
	}
	
	// insert user in to the database
	public function insertUser()
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("INSERT INTO user 
			(FullName, Address, Password, Salt, Email, ContactNo, EmailToken, IsActive, IsEmailVerified) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		
			$stmt->bind_param("sssssssii",
			$this->FullName,
			$this->Address,
			$this->Password,
			$this->Salt,
			$this->Email,
			$this->ContactNo,
			$this->EmailToken,
			$this->IsActive,
			$this->IsEmailVerified
			);
			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	// get user by email
	public function getUserByEmail($Email)
	{
		
		try{
			global $mysqli;
		

			$stmt = $mysqli->prepare("SELECT * FROM user WHERE Email = ? and IsActive = 1");
			$stmt->bind_param("s", $Email);
			$stmt->execute();
			$result = $stmt->store_result();
		
			$user = null;
			
			if($stmt->num_rows == 0) {
				return null;
			} else{

				$stmt->bind_result($Id, $FullName, $Address, $Password, $Salt, $Email,
								 $ContactNo, $IsActive, $IsEmailVerified, $EmailToken, $IsAdmin);

				$stmt->fetch();
			
				$user = new User($FullName, $Address, $Password,
								$Password, $Email, $ContactNo);
				
				$user->setId($Id);
				$user->setSalt($Salt);
				$user->setIsActive($IsActive);
				$user->setIsEmailVerified($IsEmailVerified);
				$user->setEmailTocken($EmailToken);
				$user->setIsAdmin($IsAdmin);
			
			}	
			
			return $user;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
	}
 
		// get all users
	public function getAllUsers()
	{
		
		try{
			global $mysqli;
			$sql="SELECT * FROM user";
			$result = $mysqli->query($sql);
			$requests = array();

			if($result->num_rows == 0) {
				return $requests;
			} else{
				while($row = $result->fetch_assoc()){
                    array_push($requests, $row);
                }
			}	
			
			return $requests;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
	}

	public function updateUserActive($userId)
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("UPDATE user 
			 SET IsActive = 1 WHERE Id = ?");
		 
			$stmt->bind_param("i", $userId);

			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function updateUserAsDeActive($userId)
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("UPDATE user 
			 SET IsActive = 0 WHERE Id = ?");
		 
			$stmt->bind_param("i", $userId);

			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function updateUserAsAdmin($userId)
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("UPDATE user 
			 SET IsAdmin = 1 WHERE Id = ?");
		 
			$stmt->bind_param("i", $userId);

			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function updateUserNoAdmin($userId)
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("UPDATE user 
			 SET IsAdmin = 0 WHERE Id = ?");
		 
			$stmt->bind_param("i", $userId);

			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
}