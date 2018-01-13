<?php

/*
 * ======================================
 * Nama    : Fattahul Akbar
 * email   : akbarfattahul22@gmail.com
 * company : Creative Software House
 * ======================================
*/

error_reporting(E_ALL);

//Nama folder aplikasi
$application_folder = 'applications';

define('ROOT', str_replace("\\", "/", realpath(dirname(__FILE__))) . '/');

//Menentukan BASEPATH sebagai root aplikasi
define('BASEPATH', ROOT . $application_folder . '/');

//Awal output buffering
ob_start();
session_start();

//Menjalankan program melalui router
require BASEPATH . 'core/router.php';
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$router = new Router();
$router->do_request();

//Akhir output buffering
@ob_end_flush();


//Tampilan Error
function show_error($message = ''){
    ob_end_clean();
    $error = '<html><head><title>Error</title>';
    $error .= '<style type="text/css">';
    $error .='body {margin:0; padding:0; font-family: sans-serif; color:#222;}';
    $error .= '#error {margin: 30px auto; width: 600px; '.
        ' border: 2px crimson solid; padding: 10px; '.
        ' background: pink; text-align: center;}';

    $error .= '</style>';
    $error .= '</head><body><div id="error">';
    if($message == ''){
        $message = '<b>404 -Page not found!</b>';
    }

    $error .= $message;
    $error .= '</div></body></html>';
    exit ($error);
}


?>
