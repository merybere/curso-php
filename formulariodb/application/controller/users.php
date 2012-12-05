<?php
// Definir arrayUser
$arrayUser = initArrayUser();


// $action se saca de una variable que pasa por el _GET
if (isset($_GET['action']))
	$action=$_GET['action'];
else
	// Acción por defecto
	$action='select';


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
			//$arrayUser = readUser($_GET['id'], $config['filename']);
			$arrayUser = readUser($_GET['id'], $cnx);
			
			// Mostrar el formulario vacío
			//include("../application/views/formulario.php");
			$params = array('arrayUser' => $arrayUser,
							'arrayDataPets' => readPets($cnx),
							'arrayDataCities' => readCities($cnx),
							'arrayUserCities' => array($arrayUser['cities_idcity']),
							'arrayDataCoders' => readCoders($cnx),
							'arrayUserCoders' => array($arrayUser['coders']),
							'arrayDataLanguages' => readLanguages($cnx),
							'arrayUserLanguages' => readUserLanguages($arrayUser['iduser'], $cnx));
		}
		
	case 'insert':	// Mostrar formulario (url + ?action=insert)
		if ($_POST) 	// Si el formulario tiene datos, guardarlos en un fichero
		{	
			$imageName = uploadImage($_FILES, $config['uploadDirectory']);
			$id = insertUser($_POST, $cnx, $imageName);
			
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
			$params = array('arrayUser' => $arrayUser,
			'arrayDataPets' => readPets($cnx),
				'arrayDataCities' => readCities($cnx),
				'arrayUserCities' => array(),
				'arrayDataCoders' => readCoders($cnx),
				'arrayUserCoders' => array(),
				'arrayDataLanguages' => readLanguages($cnx),
				'arrayUserLanguages' => array());
			$content = renderView('users/formulario', $config, $params);
		}
		break;
		
	case 'delete':
		if ($_POST) 
		{
			if($_POST['submit'] == 'si') 
			{
				// Borrar
				deleteUser($_GET['id'], $config);
				
				header("Location: users.php?action=select");
				exit();
			}
			else
			{
				header("Location: users.php?action=select");
				exit();
			}
		} else	// Si no tiene post, mostrar un formulario de confirmación 
		{
			$content = renderView('users/delete', $config, array());
		}
		break;
		
	case 'select':	// Mostrar la tabla (url + ?action=select)
		// Leer de fichero
		/*$arrayUsers = array();
		if (file_exists($config['filename']));
			$arrayUsers = readUsersFromFile($config['filename']);*/
		$arrayUsers = readUsers($cnx);

		$params = array('arrayUsers' => $arrayUsers);
		
		$content = renderView('users/select', $config, $params);
		
	default:
		break;
}

$params = array('userName' => 'Maria',
		'content' => $content);
echo renderLayout('layout_admin1', $config, $params);

