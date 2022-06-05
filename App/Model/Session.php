<?php namespace App\Model;

use Models\Database;

include_once "App/Model/Database.php";

class Session extends Database{
    
    public static function setSession(String $user, Int $id, String $sessionKey)
    {
        session_start();
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $id;
        $_SESSION['sessionKey'] = $sessionKey;
    }
    
    public static function closeSession(){
        session_start();
        session_destroy();
    }

    public static function isAdmin($sessionKey){
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