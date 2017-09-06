<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] 		= 	'welcome';
$route['404_override'] 				= 	'error';
$route['pendaftaran']				=	'pendaftaran/home';
$route['rajal']						=	'rajal/home';
$route['lab']						= 	'lab/home';
$route['gudangobat']				=	'gudangobat/home';
$route['kasirrajal']				=	'kasirrajal/home';
$route['e-depo']					=	'e-depo/login';
$route['e-lab']						=	'e-lab/login';
$route['igd']						=	'igd/login';
$route['coranap']					=	'coranap/login';
$route['e-ranap']					=	'e-ranap/login';
$route['admin']						=	'admin/login';
$route['translate_uri_dashes'] 		= 	FALSE;
