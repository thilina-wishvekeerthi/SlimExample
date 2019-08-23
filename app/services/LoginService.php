<?php
   require_once('ValidationService.php'); 
   require_once('../models/LoginData.php');
   require_once('../models/User.php'); 
 class LoginService
 {
     private  $validationService;
     private $email,$password;
     private $loginData, $user;


     // construct login service with request params
     function __construct($request)
     {
         // get user submited email and password
         $this->email = $request->getParam("Email");
         $this->password = $request->getParam("Password");
         // initating login data 
         $this->loginData = new LoginData( $this->email,$this->password);
         // validation service 
         $this->validationService = new ValidationService(); 
         $this->user = User::createInstance();
     }

     function LoginUser()
     {
         // restet register form session errors
        $_SESSION["loginFormErrors"] = null; 
        // set login form data to the session to prevent user insert data loses
        $_SESSION["loginFormData"] = $this ->loginData;
        // check if there  is user under the given email
        if($this->validationService->checkEmailAlreadyExsists($this->email))
        {
            // get the user by email
            $email_user = $this->user->getUserByEmail($this->email);
            // verify user hashed password and user entered passwords are correct
            if(password_verify($this->password, $email_user->getPassword()))
            {
                 // add user as logged user
                 $_SESSION["loggedUser"] = $email_user;
                 // reset login form data
                 $_SESSION["loginFormData"] = null;
                 
                if( $email_user-> getIsAdmin()==1)
                {
                    header("Location: /events/admin.php");
                    exit();
                }
               

                return true;
            }else
            {
                // set login form errors as following
                $_SESSION["loginFormErrors"] = "Incorrect password attempt";
                return false;
            }
           

            
        }
        else{
            // set login form errors as following
            $_SESSION["loginFormErrors"] = "Unregisterd email contact Admin";
            return false;
        }

     }
   
 }
?>