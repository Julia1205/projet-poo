<?php

namespace App\Libraries;

class Hash
{
    public static function encrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function check($passwordEntered, $passwordDB)
    {
        if (password_verify($passwordEntered, $passwordDB)) 
        {
            return true;
        }else{
            return false; 
        }
        
    }
}