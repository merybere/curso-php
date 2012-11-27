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
		if ($_POST) {
			$imageName = updateImage($_FILES, $_GET['id'], $config['filename'],
							$_SERVER['DOCUMENT_ROOT'] . $config['uploadDirectory']);
			updateToFile($imageName, $_GET['id'], $config['filename']);
			
			header("Location: users.php?action=select");
			
			exit();  
		} 
		else {
			// Si no hay post, mostrar el formulario vacio
			
			//Leer los usuarios
			$arrayUser = readUser($_GET['id'], $config['filename']);

// 			echo "<pre>";
// 			print_r($arrayUser);
// 			echo "</pre>";
			//Mostrar los datos del usuario ID
			
			// Mostrar el formulario vacío
			include("../application/views/formulario.php");
		}
		break;
	case 'insert':	// Mostrar formulario (url + ?action=insert)
		// Si el formulario tiene datos, guardarlos en un fichero
		if ($_POST) {
			//die("Guardar datos");
	
			$imageName = uploadImage($_FILES, 
					$_SERVER['DOCUMENT_ROOT'] . $config['uploadDirectory']);
			writeToFile($imageName, $config['filename']);
			
			// Al insertar los datos y hacer submit, los datos se insertan en 
			// el fichero, y tiene que mostrar la tabla
			// Cambiamos la cabecera, y volvemos a llamar al mismo controlador
			// users.php, con la acción vacía o bien con select, que es lo mismo
			header("Location: users.php?action=select");
			// Parar la ejecución del php
			exit();
		}
		else {
			// Si no tiene post, mostrar el formulario vacío
			include("../application/views/formulario.php");
		}
		
		// acatar la ejecución con mensaje
		//die('Mostrar formulario');
		break;
	case 'delete':
		
		if ($_POST) {
			
			if($_POST['submit'] == 'si') 
				// Borrar
				deleteUser($_GET['id'], $config['filename'], 
						$_SERVER['DOCUMENT_ROOT'] . $config['uploadDirectory']);
				
			header("Location: users.php?action=select");
			exit();
		} else {
			
			// Si no tiene post, mostrar un formulario de confirmación
			include("../application/views/delete.php");
		}
		break;
	case 'select':	// Mostrar la tabla (url + ?action=select)
		$arrayUsers = array();
		//die("Mostrar tabla");
		if (file_exists($config['filename']));
			$arrayUsers = readUsersFromFile($config['filename']);
		
		include("../application/views/select.php");
		
		// acabar la ejecución con mensaje
		//die('Mostrar tabla');
	default:
		break;
}

$content = "Esto es content";
// Incluir el layout admin para este controlador
include '../application/layouts/layout_admin1.php';