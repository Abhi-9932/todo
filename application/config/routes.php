<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#custome
$route['register'] = 'AuthController/register';
$route['login'] = 'AuthController/index';
$route['login-check'] = 'AuthController/login';
$route['logout'] = 'AuthController/logout';


$route['dashboard'] = 'AuthController/dashboard';
$route['user-delete'] = 'AuthController/userdelete';
