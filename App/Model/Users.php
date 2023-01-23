<?php

namespace App\Model;

include_once "App/Model/Database.php";

use Models\Database;

class Users extends Database
{
    // Get all users from DB
    public static function all(): array
    {
        return Database::getAll('users');
    }

    // Add one user to DB
    public static function add(array $data)
    {
        Database::addOne('users', 'username, email, password, session_key, role', '?, ?, ?, ?, ?', $data);
    }

    // Get one user from DB by his username
    public static function findByUsername(String $username): array
    {
        $user = Database::getOne('users', 'username', $username);
        return $user;
    }

    // Get one user from DB by his session key
    public static function findBySessionKey(String $sessionKey): array
    {
        $user = Database::getOne('users', 'session_key', $sessionKey);
        return $user;
    }

    // Get one user from DB by his ID
    public static function findById(String $id): array
    {
        $user = Database::getOne('users', 'id', $id);
        return $user;
    }

    // Update one user from DB
    public static function updateUser(array $data, Int $id)
    {
        Database::updateOne('users', $data, 'id', $id);
    }

    // Delete one user from DB
    public static function deleteUser(Int $id)
    {
        Database::deleteOne('users', 'id', $id);
    }
}
