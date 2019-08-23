<?php
 class PasswordService
 {
    
    //salt - You can manually pass in your own salt, although password_hash randomly generates a salt for each password.
    // cost - The algorithmic cost to be used. Default value is 10.
    // https://www.sitepoint.com/hashing-passwords-php-5-5-password-hashing-api/

    public static function generatePasswordHash($Password)
    {
        $options = array(
            'cost' => 12,
          );
          
          return password_hash($Password, PASSWORD_BCRYPT, $options);
    }
    
 }

?>