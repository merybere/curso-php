<?php

//require_once '/../models/usersModel.php';
//require_once '/../models/applicationModel.php';

// Lectura del fichero de configuración
$configFile = '../application/configs/config.ini';
$context = 'production';
$config = readConfig($configFile, $context);

// $action se saca de una variable que pasa por el _GET
if (isset($_GET['action']))
	$action=$_GET['action'];
else
	// Acción por defecto
	$action='select';

// Definir arrayUser
$arrayUser = initArrayUser();

// Switch para tratar las posibles acciones. La acción select y default las agrupamos
switch ($action)
{
	case 'update':
		if ($_POST) 
		{
			$imageName = updateImageDrive($_FILES, $_GET['id'], $config['filename'],
							$config['uploadDirectory']);
			
			$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
			$client = Zend_Gdata_ClientLogin::getHttpClient(
					$config['user']
					, $config['psw']
					, Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);
			updateToDriveFile($client, $imageName, $_GET['iduser'], $config['spreadsheetKey']);
			
			header("Location: users.php?action=select");
			exit();  
		} 
		else 	// Si no hay post, mostrar el formulario
		{	
			//Leer los datos del usuario
			$arrayUser = readUser($_GET['id'], $config['filename']);
			
			// Mostrar el formulario vacío
			//include("../application/views/formulario.php");
			$params = array('arrayUser' => $arrayUser);
			$content = renderView('formulario', $config, $params);
		}
		break;
		
	case 'insert':	// Mostrar formulario (url + ?action=insert)
		if ($_POST) 	// Si el formulario tiene datos, guardarlos en un fichero
		{	
			$imageName = uploadImage($_FILES, $config['uploadDirectory']);
			
			$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
			$client = Zend_Gdata_ClientLogin::getHttpClient(
					$config['user']
					, $config['psw']
					, Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);
			writeToDriveFile($client, $_POST, $imageName, $config['spreadsheetKey']);
			
			// Al insertar los datos y hacer submit, los datos se insertan en 
			// el fichero, y tiene que mostrar la tabla
			// Cambiamos la cabecera, y volvemos a llamar al mismo controlador
			// users.php, con la acción vacía o bien con select, que es lo mismo
			header("Location: users.php?action=select");
			// Parar la ejecución del php
			exit();
		}
		else	// Si no tiene post, mostrar el formulario vacío 
		{
			//include("../application/views/formulario.php");
			$params = array('arrayUser' => $arrayUser);
			$content = renderView('formulario', $config, $params);
		}
		break;
		
	case 'delete':
		if ($_POST) 
		{
			if($_POST['submit'] == 'si') 
				// Borrar
				deleteUser($_GET['id'], $config['filename'], $config['uploadDirectory']);
				
			header("Location: users.php?action=select");
			exit();
		} else	// Si no tiene post, mostrar un formulario de confirmación 
		{
			//include("../application/views/delete.php");
			$content = renderView('delete', $config, array());
		}
		break;
		
	case 'select':	// Mostrar la tabla (url + ?action=select)

		$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient(
			$config['user']
			, $config['psw']
			, Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);

// 		$spreadsheetService = new Zend_Gdata_Spreadsheets($client);
// 		$query = new Zend_Gdata_Spreadsheets_ListQuery();
// 		$query->setSpreadsheetKey($config['spreadsheetKey']);
// 		$listFeed = $spreadsheetService->getListFeed($query);
		
		$arrayUsers = array();

		$arrayUsers = readUsersFromDrive($client, $config['spreadsheetKey']);

		$params = array('arrayUsers' => $arrayUsers);
		//include("../application/views/select.php");
		$content = renderView('select', $config, $params);
		
	default:
		break;
}

include '/../layouts/layout_admin1.php';
