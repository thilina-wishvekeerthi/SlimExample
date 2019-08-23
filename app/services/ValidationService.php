<?php
 require_once('../models/User.php');  
class ValidationService{

    private $user;
     // construct login service with request params
     function __construct()
     {
        $this ->user = User::createInstance();
     }
    public function checkPasswordMatches($password, $repassword)
    {
        return  strcmp($password, $repassword) === 0;
    }

    public function checkEmailAlreadyExsists($email)
    {
        return $this->user->getUserByEmail($email) !== null;
    }

    

}

?>


