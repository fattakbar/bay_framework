<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

if(! defined('BASEPATH')) exit('No direct script access allowed');

class Database{
    private static $db_config;
    private static $db_handler;

    public function __construct() {}
    public function __clone(){
        trigger_error('Clone is not allowed', E_USER_ERROR);
    }

    public static function &handler($config_name = 'default'){
        if(!isset (self::$db_handler)){
            self::connect($config_name);
        }
        return self::$db_handler;
    }

    private static function connect($config_name = 'default'){
        //menganbil pengaturan dari file config pada file Database
        require BASEPATH.'config/database.php';

        self::$db_config = $db[$config_name];
        self::$db_handler = @mysql_connect(self::$db_config['hostname'],
        self::$db_config['username'], self::$db_config['password']);

        if(self::$db_handler != 0){
            if(mysql_select_db(self::$db_config['database'], self::$db_handler)){
                return TRUE;
            }
        }
        return FALSE;
    }

    private static function disconnect(){
        if(@mysql_close(self::$db_handler) != 0){
            return TRUE;
        } else {
          return FALSE;
        }
    }
}

?>
