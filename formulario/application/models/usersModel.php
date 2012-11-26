<?php

// MODELO DE USUARIOS

/* echo "<pre>Post: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Get: ";
print_r($_GET);
echo "</pre>";

echo "<pre>Post: ";
print_r($_FILES);
echo "</pre>";
 */


/**
 * Upload image
 * @param array $_FILES Array FILES
 * @return string Image final name
 */
function uploadImage($_FILES)
{
	//TODO: Read from config.ini
	
	// Cargar una foto en uploads
	$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/uploads";
	//echo $uploadDirectory;
	$destination = $uploadDirectory . "/" . $_FILES['photo']['name'];
	
	$filename = $_FILES['photo']['tmp_name'];
	
	// Renombrar el fichero, si ya existe en la carpeta
	$path_parts = pathinfo($destination);
	echo"<pre>";
	print_r($path_parts);
	echo"</pre>";
	
	$name = $path_parts['filename'] . "." . $path_parts['extension'];
	
	$i = 0;
	
	while(in_array($name, scandir($uploadDirectory))) {
		$i++;
		$name = $path_parts['filename'] . "_" . $i . "." . $path_parts['extension'];
	}
	
	$destination = $uploadDirectory . "/" . $name;
	move_uploaded_file($filename, $destination);
	
	return $name;
}

/**
 * Write to file
 * Cargar en un fichero .txt todos los datos del formulario, cada elemento
 * del formulario en una línea. Si un elemento es un array, separar cada ítem
 * por pipes (|) en una misma línea. Cada vez que se carguen datos nuevos en
 * el formulario, añadirlos al mismo fichero.
 * @param string $imageName Image name
 */
function writeToFile($imageName) 
{
	echo "<pre>Post: ";
	print_r($_POST);
	echo "</pre>";
	die;
	// Para cada elemento de $_POST, si el elemento es un array, hacer un implode
	// separado por piles
	foreach($_POST as $value) {
		if(is_array($value)) {
			// Convertir el array en una sola string, separada por comas
			$value = implode(',', $value);
		}
		// Añadir cada valor a un vector
		$arrayUser[]=$value;
	}
	// Agregar la foto
	$arrayUser[]=$imageName;
	
	// Convertir el array con todos los datos a una sola línea separada por |
	$textUser = implode('|', $arrayUser);

	//echo $textUser;
	
	// Rellenar el fichero con los contenidos; si el fichero existe, con FILE_APPEND
	// añadimos un nuevo texto al final
	file_put_contents("users.txt", $textUser . "\r\n", FILE_APPEND);
}

/**
 * read users from file
 * @return array: Users array
 */
function readUsersFromFile()
{
	//TODO: Read from config.ini
	
	$filename = "users.txt";
	$arrayUsers = array();
	if(file_exists($filename)) {
		// Extraer los datos de un fichero en un string
		$usersText = file_get_contents($filename);
	
		// Dividir el string por líneas
		$arrayUsers = explode("\n", $usersText);
	}
	return $arrayUsers;
}

/**
 * Read user from file at a line position
 * @param int: line from file
 * @return string: User line
 */
function readUserFromFile($line)
{
	//TODO: Read from config.ini

	$filename = "users.txt";

	// Extraer los datos de un fichero en un string
	$usersText = file_get_contents($filename);

	// Dividir el string por líneas
	$arrayUsers = explode("\n", $usersText);

	return $arrayUsers[$line];
}

/**
 * 
 * @param int $id
 * @return array: User array
 */
function readUser($id)
{
	$textUser = readUserFromFile($id);
	$arrayUser = explode('|', $textUser);
	return $arrayUser;
}

function initArrayUser()
{
	$arrayUser = array();
	for ($i = 0; $i < 10; $i++) {
		$arrayUser[$i] = null;
	}
	return $arrayUser;
}