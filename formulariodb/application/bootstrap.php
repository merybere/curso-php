<?php

$config = readConfig('../application/configs/config.ini', APPLICATION_ENV);
$cnx = connect($config);

// Crear el espacio de variables global 
session_start();

// Añadir un elemento a la sesión
//$_SESSION['user'] = 'maria';

// Eliminar un elemento de la sesión
//unset($_SESSION['user']);

// Destruir la sesión, todo el espacio común
//session_destroy();

$arrayRequest = setRequest();

if (isset($_SESSION['iduser']))
	$user = readUser($_SESSION['iduser'], $cnx);
else
	// Si no está el usuario autenticado, se crea un rol de usuario Guest por defecto
	$user['roles_idrol'] = '2';

$arrayRequest = acl($arrayRequest, $user['roles_idrol'], $cnx);

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