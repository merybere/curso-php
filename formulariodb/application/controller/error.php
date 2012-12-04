<?php

// Switch para tratar las posibles acciones. La acción select y default las agrupamos
switch ($_GET['action'])
{
	case '404':	
		// Inyectar el error, página 404
		header("HTTP/1.0 404 Not Found");
		$content = renderView('error/404', $config, array());
		break;
		
	case '403':	
		// Inyectar el error, página 404
		header("HTTP/1.0 403 Not Found");
		$content = renderView('error/403', $config, array());
		break;
		
	default:
		break;
}

include '../application/layouts/layout_admin1.php';
