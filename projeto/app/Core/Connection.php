<?php

namespace App\Core;

use PDO; 
use PDOException;

class Connection
{

    private static $instance;

    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    private function __wakeup()
    {
        
    }


    /** @return PDO */
    public static function getInstance(): PDO
    {
        if(empty(self::$instance)){
            try {
                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                    DB_USER,
                    DB_PASS,
                    array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_CASE => PDO::CASE_NATURAL,
                    )
                );
                return self::$instance;
            } catch (\PDOException $e) {
                return $e;
            }
        }
        
        return self::$instance;
    }

    /** Start database transaction
     * @return void
     */
    public static function beginTransaction() {
        if(empty(self::$instance)){
            return null;
        }

        return self::$instance->beginTransaction();
    }

    /**
    * commit changes on opened transaction
    * @return void
    */   
    public static function commit() {
        if(empty(self::$instance)){
            return null;
        }
        return self::$instance->commit();
    }

    /**
    * Roolback changes on opened transaction
    * @return void
    */   
    public static function rollback() {
        if(empty(self::$instance)){
            return null;
        }
        return self::$instance->rollBack();
    }
}