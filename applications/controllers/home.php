<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

if (! defined('BASEPATH')) exit('No direct script access allowed');

class HomeController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    function index(){
        $this->load->view('home');
    }
}

?>
