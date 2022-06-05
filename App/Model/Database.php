<?php
namespace Models;

abstract class Database {
    
    private static $_dbConnect;
    
    private static function setDb()
    {
        self::$_dbConnect = new \PDO( 'mysql:host=YOUR_HOST;dbname=YOUR_DB_NAME;charset=utf8', 'YOUR_USERNAME', 'YOUR_PASSWORD');
        self::$_dbConnect->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
    }
    
    protected static function getDb()
    {
        if( self::$_dbConnect == null)
        {
            self::setdB();
        }
        
        return self::$_dbConnect;
    }
    
    protected static function getAll( String $table )
    {
        $sql = 'SELECT * FROM ' . $table;
        $query = self::getDb()->prepare( $sql );
        $query->execute();
        
        return $query->fetchAll( \PDO::FETCH_ASSOC );
    }
    
    protected static function getOne( String $table, String $condition, String $value )
    {
        $sql = 'SELECT * FROM '. $table .' WHERE '. $condition .' = ?';
        $query = self::getDb()->prepare( $sql );
        $query->execute( [$value] );

        return $query->fetch( \PDO::FETCH_ASSOC );
    }

    protected static function addOne( String $table, String $columns, String $values, Array $data )
    {
        $sql = 'INSERT INTO '. $table .' ( '. $columns .' ) VALUES ('. $values .')';
        $query = self::getDb()->prepare( $sql );
        $query->execute( $data );
    }

    protected static function updateOne( String $table, Array $newData, String $condition, Int $uniq )
    {
        $sets = '';
        foreach( $newData as $key => $value )
        {
            $sets .= "$key = :$key,";
        }
        $sets = substr( $sets, 0, -1 );
        
        $sql = "UPDATE $table SET $sets WHERE $condition = :$condition";
        $query = self::getDb()->prepare( $sql );
        
        foreach( $newData as $key => $value )
        {
            $query->bindvalue( ":$key", $value );
        }
        
        $query->bindvalue( ":$condition", $uniq );
        $query->execute();
    }

    protected static function deleteOne( $table, $column, $value )
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $column . ' = ?';
        $query = self::getDb()->prepare( $sql );
        $query->execute([$value]);
    }
}