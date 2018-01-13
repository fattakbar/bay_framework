<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

if(! defined('BASEPATH')) exit('No direct script access allowed');

class Controller{
    protected $load;
    private static $instance;
    public $config;

    public function __construct(){
        self::$instance = $this;
        require_once BASEPATH . 'core/loader.php';
        require_once BASEPATH . 'core/config.php';
        $this->load = new Loader();
        $this->config = new Config();

        if(!$this->config->item('site_open')){
            show_error('Maaf, web ini sedang dalam perbaikan.');
        }
        if($this->config->item('use_database')){
            spl_autoload_register('load_db');
        }
        //Anda bisa menambahkan Library lain disini!!
    }

    public static function &get_instance(){
        return self::$instance;
    }
}

function &get_instance(){
    return Controller::get_instance();
}

function base_url($clear = false){
    $CI =& Controller::get_instance();
    if($clear){
        return $CI->config->item('base_url');
    }
        return $CI->config->item('base_url') . 'index.php/';
}

function load_db(){
    include BASEPATH.'core/database.php';
}

function redirect($uri = '', $method = 'location', $http_response_code = 302){
    if ( ! preg_match('#^https?://#i', $uri)){
        $uri = site_url($uri);
    }

    switch($method){
        case 'refresh' : header("Refresh:0;url=".$uri);
            break;
        default : header("Location: ".$uri, TRUE, $http_response_code);
            break;
    }
    exit;
}

?>
