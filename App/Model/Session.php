<?php namespace App\Model;

use Models\Database;

include_once "App/Model/Database.php";

class Session extends Database{
    
    // Login user
    public static function setSession(String $user, Int $id, String $sessionKey)
    {
        session_start();
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $id;
        $_SESSION['sessionKey'] = $sessionKey;
    }
    
    //logout user
    public static function closeSession()
    {
        session_start();
        session_destroy();
    }

    // Check if user has 'ADMIN' role
    public static function isAdmin(String $sessionKey) :bool
    {
        $user = Users::findBySessionKey($sessionKey);
        if($user['role'] === "ADMIN")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>