<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

if(! defined('BASEPATH')) exit('No direct script access allowed');

class Router{
    private $_segment = array();
    private $_controller;
    private $_method;
    private $_var = array();

    public function __construct(){
        $this->_set_uri();
        $this->_set_controller();
        $this->_set_method();
        $this->_set_vars();
    }

    //Mencari dan menetapkan segmen dari request URL
    private function _set_uri(){
        //Mengambil semua segmen pada string setelah script name
        $uri_string = str_replace( $_SERVER['REQUEST_URI'],
            '', $_SERVER['SCRIPT_NAME']);

        //Jika file index tidak di deklarasikan
        if($uri_string == 'index.php'){
            $uri_string = '';
        } else {
            $uri_string = str_replace( $_SERVER['SCRIPT_NAME'],
                '', $_SERVER['REQUEST_URI']);

            $uri_string = preg_replace("|/*(.+?)/*$|", "\\1",
                str_replace("\\", "/", $uri_string));
            $uri_string = trim($uri_string, '/');
        }
        $this->_segment = preg_split('[\\/]', $uri_string, 0, PREG_SPLIT_NO_EMPTY);
    }

    //mencari class controller
    private function _set_controller(){
        if(!isset ($this->_segment[0])){
            require BASEPATH.'config/config.php';
            $this->_segment[0] = $config['default_controller'];
        }
        $controller_path = BASEPATH.'controllers/'.$this->_segment[0].'.php';
        if(file_exists($controller_path)){
            require BASEPATH.'core/controller.php';
            require $controller_path;
            $class = ucfirst($this->_segment[0]).'Controller';
            if(!class_exists($class)){
                show_error();
            }
            $this->_controller = new $class();
        } else {
            show_error();
        }
    }

    //Mencari class method
    private function _set_method(){
        //jika tidak ada method yang di deklarasikan, maka tetapkan ke index
        if(!isset ($this->_segment[1])){
            $this->_segment[1] = 'index';
        }
        //memeriksa apakah ada method yang ditemukan
        if(method_exists($this->_controller, $this->_segment[1])){
            $this->_method = $this->_segment[1];
            //Jika private method, menampilkan 404 not found
            if(substr($this->_method, 0, 1) == '_'){
                show_error();
            }
        } else {
            show_error();
        }
    }

    //Tetapkan variabel dari url segment
    private function _set_vars(){
        if(isset ($this->_segment[2])){
            $this->_var = array_slice($this->_segment, 2);
        }
    }

    public function do_request(){
        call_user_func_array(array(&$this->_controller, $this->_method), $this->_var);
    }

    public function get_segment(){
        return $this->_segment;
    }
}

?>
