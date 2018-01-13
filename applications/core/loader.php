<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

if(! defined('BASEPATH')) exit('No direct script access allowed');

class Loader{

    public function __construct(){
    }

    public function view($view, $var = ''){
        @ob_start();
        if(is_array($var)){
            $the_vars = extract($var);
        }
        include BASEPATH.'views/'.$view.'.php';
        @ob_end_flush();
    }

    public function model($model, $name = ''){
      //Mengambil instance
      $CI =& get_instance();
      //Mengecek apakah nama kosong
      if($name == ''){
          $name = strtolower($model);
      }
      //Jika nama ada akan menampilkan pesan error
      if(isset ($CI->$name)){
          show_error('Error - model name "'. $name .'" is already defined');
      } else {
          $filename = BASEPATH.'models/'.strtolower($model).'.php';
          if(file_exists($filename)){
              require_once BASEPATH.'core/model.php';
              require_once $filename;
              $model = ucfirst(strtolower($model));
              $CI->$name = new $model();
          } else {
              show_error('Error - Model file "'. $name .'" could not be found');
          }
      }
    }

    public function library($lib, $name = ''){
        //Mengambil instance
        $CI =& get_instance();
        //Mengecek apakah nama kosong
        if($name == ''){
            $name = strtolower($lib);
        }
        //jika nama ada akan menampilkan pesan error
        if(isset ($CI->$name)){
            show_error('Error - library name "'. $name .'" is already defined');
        } else {
            $lib = ucfirst(strtolower($lib));
            $filename = BASEPATH.'libraries/'.$lib.'.php';
            if(file_exists($filename)){
                require_once $filename;
                $CI->$name = new $lib();
            } else {
                show_error('Error - Model file "'. $name .'" could not be found');
            }
        }
    }
}

?>
