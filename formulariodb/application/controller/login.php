<?php

// El modelo del controlador, lo incluye el controlador
include_once(APPLICATION_PATH . "/models/loginModel.php");

// Switch para tratar las posibles acciones. La acción select y default las agrupamos
switch ($_GET['action'])
{
	case 'index':
	case 'login':	
		if ($_POST){
			_debug($_POST);
			loginUser($cnx, $_POST);
			// Saltar al backend
			header ("Location: /users");
			exit();
		}
		else
		{
			$content = renderView('login/login', $config, array());
		}
		break;
	case 'logout':
		session_destroy();
		header("Location: /index");
		exit();
		break;
	default:
		break;
}

echo renderLayout('layout_login', $config, array());
