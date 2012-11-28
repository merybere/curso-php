<?php
// CONTROLADOR
// echo "<pre>Post: ";
// print_r($_POST);
// echo "</pre>";

// echo "<pre>Get: ";
// print_r($_GET);
// echo "</pre>";

// echo "<pre>Post: ";
// print_r($_FILES);
// echo "</pre>";

require_once '../application/models/usersModel.php';
require_once '../application/models/applicationModel.php';

define ('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

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
			$imageName = updateImage($_FILES, $_GET['id'], $config['filename'],
							$config['uploadDirectory']);
			updateToFile($imageName, $_GET['id'], $config['filename']);
			
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
			writeToFile($imageName, $config['filename']);
			
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
		$arrayUsers = array();
		//die("Mostrar tabla");
		if (file_exists($config['filename']));
			$arrayUsers = readUsersFromFile($config['filename']);

		$params = array('arrayUsers' => $arrayUsers);
		//include("../application/views/select.php");
		$content = renderView('select', $config, $params);
		
		// acabar la ejecución con mensaje
		//die('Mostrar tabla');
		
	default:
		break;
}

include '../application/layouts/layout_admin1.php';
