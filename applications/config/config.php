<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

if (! defined('BASEPATH')) exit('No direct script access allowed');

$config['site_open'] = TRUE;
$config['use_database'] = TRUE;

//Base URL Dynamic
if(isset($_SERVER['HTTP_HOST'])){
    $config['base_url'] = isset($_SERVER['HTTPS']) &&strtolower($_SERVER['HTTPS']) == 'on'
      ? 'https': 'http';
    $config['base_url'] .= '://'. $_SERVER['HTTP_HOST'];
    $config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), '',
      $_SERVER['SCRIPT_NAME']);
}else{
    $config['base_url'] = 'http://localhost/bay_framework/';
}

//default controller
$config['default_controller'] = 'welcome';
$config['404_override'] = '';

?>
