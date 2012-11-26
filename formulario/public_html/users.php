<?php
// CONTROLADOR
echo "<pre>Post: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Get: ";
print_r($_GET);
echo "</pre>";

echo "<pre>Post: ";
print_r($_FILES);
echo "</pre>";
require_once '../application/models/usersModel.php';
require_once '../application/models/applicationModel.php';

// Lectura del fichero de configuración
$configFile = '../application/configs/config.ini';
$context = 'development';
$config = readConfig($configFile, $context);

// $action se saca de una variable que pasa por el _GET
if (isset($_GET['action']))
	$action=$_GET['action'];
else
	// Acción por defecto
	$action='select';

// Definir arrayUser
$arrayUser = initArrayUser();		

$usersText = "users.txt";

// Switch para tratar las posibles acciones. La acción select y default las agrupamos
switch ($action)
{
	case 'update':
		//die("Esto es update");
		if ($_POST) {
			
		} 
		else {
			// Si no hay post, mostrar el formulario vacio
			
			//Leer los usuarios
			$arrayUser = readUser($_GET['id']);

			echo "<pre>";
			print_r($arrayUser);
			echo "</pre>";
			//Mostrar los datos del usuario ID
			
			// Mostrar el formulario vacío
			include("../application/views/formulario.php");
		}
		break;
	case 'insert':	// Mostrar formulario (url + ?action=insert)
		// Si el formulario tiene datos, guardarlos en un fichero
		if ($_POST) {
			//die("Guardar datos");
	
			$imageName = uploadImage($_FILES);
			writeToFile($imageName);

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
	case 'detele':
		break;
	case 'select':	// Mostrar la tabla (url + ?action=select)
		$arrayUsers = array();
		if (file_exists($usersText))
			$arrayUsers = readUsersFromFile();
		
		include("../application/views/select.php");
		
		// acabar la ejecución con mensaje
		//die('Mostrar tabla');
	default:
		break;
}