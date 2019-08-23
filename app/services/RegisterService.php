<?php
 require_once('../models/User.php');  
 require_once('ValidationService.php'); 
 require_once('PasswordService.php'); 
 class RegisterService
 {
     private $user , $validationService;

     // construct register service with request params
     function __construct($request)
     {
         // initiate user by user submitted form data
        $this->user = new User(
                $request->getParam("FullName"),
                $request->getParam("Address"),
                $request->getParam("Password"),
                $request->getParam("Repassword"),
                $request->getParam("Email"),
                $request->getParam("ContactNo")
            );
            
        // initaite validation service 
         $this->validationService = new ValidationService();  
     }


     function registerUser()
     {
        // restet register form session errors
        $_SESSION["RegisterFormErrors"] = null; 

        // save register form data in session
        $_SESSION["registerFormData"] = $this->user;

        // validating before registering the user 
        
        // check if user passwords matches
        if(!$this->validationService
            ->checkPasswordMatches($this->user->getPassword(), $this->user->getRepassword())) 
        {   // setting register form session errors
            $_SESSION["RegisterFormErrors"] = "Passwords Do Not Match";
            return false;
        }

        // check if user is already registered
        if($this->validationService
         ->checkEmailAlreadyExsists($this->user->getEmail()))
        {
            $_SESSION["RegisterFormErrors"] = "Email Already Exsists";
            return false;
        }

        // set hased password
        $this->user
        ->setPassword(PasswordService::generatePasswordHash($this->user->getPassword()));

        // set salt
        $this->user
        ->setSalt(PasswordService::generatePasswordHash($this->user->getPassword()));

        // set user active
        $this->user->setIsActive(1);

        // set user email verified
        $this->user->setIsEmailVerified(1);

        // set email tocken
        $this->user->setEmailTocken( $this->user->getSalt());

        // save user in to the db and get if it was success or not
        $complete = $this->user->insertUser();

        // if data is saved successfull do the following
        if($complete)
        {
         // restet register form data in session
          $_SESSION["registerFormData"] = null;
        }
        return  $complete;
     }

     

    
 }
?>