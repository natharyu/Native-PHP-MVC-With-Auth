<?php

namespace Models;

abstract class Database
{

    private static $_dbConnect;
    private static $host = '_YOUR_DB_HOST_';
    private static $user = '_YOUR_DB_USER_';
    private static $pass = '_YOUR_PASSWORD_'; // set '' if no password
    private static $dbname = '_YOUR_DB_NAME_';

    private static function setDb()
    {
        self::$_dbConnect = new \PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$user, self::$pass);
        self::$_dbConnect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
    }

    protected static function getDb()
    {
        if (self::$_dbConnect == null) {
            self::setdB();
        }

        return self::$_dbConnect;
    }

    // Get all from a table
    protected static function getAll(String $table): array
    {
        $sql = 'SELECT * FROM ' . $table;
        $query = self::getDb()->prepare($sql);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Get one from a table
    protected static function getOne(String $table, String $condition, String $value): array
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition . ' = ?';
        $query = self::getDb()->prepare($sql);
        $query->execute([$value]);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if (gettype($result) === 'boolean') {
            return $result = [];
        } else {
            return $result;
        }
    }

    // Add one to table
    protected static function addOne(String $table, String $columns, String $values, array $data): void
    {
        $sql = 'INSERT INTO ' . $table . ' ( ' . $columns . ' ) VALUES (' . $values . ')';
        $query = self::getDb()->prepare($sql);
        $query->execute($data);
    }

    // Update one from table
    protected static function updateOne(String $table, array $newData, String $condition, Int $uniq): void
    {
        $sets = '';
        foreach ($newData as $key => $value) {
            $sets .= "$key = :$key,";
        }
        $sets = substr($sets, 0, -1);

        $sql = "UPDATE $table SET $sets WHERE $condition = :$condition";
        $query = self::getDb()->prepare($sql);

        foreach ($newData as $key => $value) {
            $query->bindvalue(":$key", $value);
        }

        $query->bindvalue(":$condition", $uniq);
        $query->execute();
    }

    // Delete one from table
    protected static function deleteOne($table, $column, $value): void
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $column . ' = ?';
        $query = self::getDb()->prepare($sql);
        $query->execute([$value]);
    }
}
