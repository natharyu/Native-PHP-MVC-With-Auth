<?php namespace App\Model;

include_once "App/Model/Database.php";

use Models\Database;

class Users extends Database
{
    //Récupère tous les utilisateurs de la BDD
    public static function all()
    {
        return Database::getAll('users');
    }

    public static function add(Array $data)
    {
        Database::addOne( 'users', 'username, email, password, session_key, role', '?, ?, ?, ?, ?', $data );
    }

    public static function findByUsername(String $username)
    {
        $user = Database::getOne( 'users', 'username', $username );
        return $user;
    }

    public static function findBySessionKey(String $sessionKey)
    {
        $user = Database::getOne( 'users', 'session_key', $sessionKey );
        return $user;
    }

    public static function findById(String $id)
    {
        $user = Database::getOne( 'users', 'id', $id );
        return $user;
    }

    public static function updateUser(Array $data, Int $id)
    {
        Database::updateOne( 'users', $data, 'id', $id );
    }

    public static function deleteUser(Int $id)
    {
        Database::deleteOne( 'users', 'id', $id );
    }
}