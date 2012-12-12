<?php

$config = readConfig('../application/configs/config.ini', APPLICATION_ENV);

// Crear el espacio de variables global 
session_start();

$root = dirname(__FILE__);

set_include_path($root.'/lib'.PATH_SEPARATOR.get_include_path());


switch($arrayRequest['controller'])
{
	case 'users':
		include("../application/controllers/users.php");	
		break;
	case 'error':
		include("../application/controllers/error.php");
		break;
	case 'login':
		include("../application/controllers/login.php");
		break;
	case 'index':
	default:
		include("../application/controllers/index.php");
		break;
}

