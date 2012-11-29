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
function uploadImage($_FILES, $uploadDirectory)
{
	// Si la imagen no existe, asignar como nombre una cadena vacía,
	// para insertarla en el fichero de usuarios
	if (!isset($_FILES['photo']['name']))
		return $name = '';
	
	// Cargar una foto en uploads
	$destination = $uploadDirectory . "/" . $_FILES['photo']['name'];
	
	$filename = $_FILES['photo']['tmp_name'];
	
	// Renombrar el fichero, si ya existe en la carpeta
	$path_parts = pathinfo($destination);
	
	$name = $path_parts['filename'] . "." . $path_parts['extension'];
	
	$i = 0;
	
	while(in_array($name, scandir($uploadDirectory))) 
	{
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
 * @param string $filename
 */
function writeToFile($imageName, $filename) 
{	
	// Para cada elemento de $_POST, si el elemento es un array, hacer un implode
	// separado por pipes
	foreach($_POST as $value) 
	{
		if(is_array($value)) 
		{
			// Convertir el array en una sola string, separada por comas
			$value = implode(',', $value);
		}
		// Añadir cada valor a un vector
		$arrayUser[] = $value;
	}
	// Agregar la foto
	$arrayUser[] = $imageName;
	
	// Convertir el array con todos los datos a una sola línea separada por |
	$textUser = implode('|', $arrayUser);

	//echo $textUser;
	
	// Rellenar el fichero con los contenidos; si el fichero existe, con FILE_APPEND
	// añadimos un nuevo texto al final
	file_put_contents($filename, $textUser . "\r\n", FILE_APPEND);
}

/**
 * read users from file
 * @return array: Users array
 */
function readUsersFromFile($filename)
{
	
	$arrayUsers = array();
	if(file_exists($filename)) 
	{
		// Extraer los datos de un fichero en un string
		$usersText = file_get_contents($filename);
	
		// Dividir el string por líneas
		$arrayUsers = explode("\n", $usersText);
	}
	return $arrayUsers;
}

/**
 * Read user from file at a line position
 * @param int $line: line from file
 * @return string: User line
 */
function readUserFromFile($line, $filename)
{
	// Extraer los datos de un fichero en un string
	$usersText = file_get_contents($filename);

	// Dividir el string por líneas
	$arrayUsers = explode("\n", $usersText);

	return $arrayUsers[$line];
}

/**
 * Read user from file at a line position
 * @param int $id: line from file
 * @param string $filename
 * @return array: User array
 */
function readUserFile($id, $filename)
{
	$textUser = readUserFromFile($id, $filename);
	$arrayUser = explode('|', $textUser);
	return $arrayUser;
}

/**
 * Init array to null
 * @return array: User array
 */
function initArrayUser()
{
	$arrayUser = array();
	for ($i = 0; $i < 10; $i++) 
	{
		$arrayUser[$i] = null;
	}
	return $arrayUser;
}

/**
 * Update the user at line id
 * @param string $imageName
 * @param int $id
 * @param string $filename
 */
function updateToFile($imageName, $id, $filename)
{
	$arrayUsers = readUsersFromFile($filename);
	
	foreach($_POST as $value) 
	{
		// Si alguno de los elementos del $_POST tiene varios elementos,
		// convertirlo en una cadena separada por comas
		if(is_array($value)) 
		{
			$value = implode(',', $value);
		}
		$arrayUser[] = $value;
	}
	// Añadir la imagen como último elemento del array de datos del usuario
	$arrayUser[] = $imageName;
	// Convertir el array de usuario en una cadena en la que cada elemento
	// se separa con el carácter |
	$textUser = implode('|', $arrayUser);
	// Sustituir el usuario en la línea $id por la actualización
	$arrayUsers[$id] = $textUser;
	// Convertir el array de usuarios a cadena de texto
	$textUsers = implode("\r\n", $arrayUsers);
	// Volcar al fichero
	file_put_contents($filename, $textUsers);
}

/**
 * Update user image
 * @param array $_FILES Files array
 * @param int $id User id
 * @param string $filename File with users
 * @param $uploadDirectory location of the images
 * @return string: image
 */
function updateImage($_FILES, $id, $filename, $uploadDirectory)
{
	$arrayUser = readUser($id, $filename);
	// La imagen es el último elemento del array
	
	$filename = $arrayUser[10];
	// Si _FILES trae una imagen nueva, borrar la que ya hay y sobreescribir
	// si no hay nada, no se toca el fichero
	if (isset($_FILES['photo']['name'])) 
	{
		deleteImage($filename, $uploadDirectory);
		// Subir nueva imagen
		$filename = uploadImage($_FILES, $uploadDirectory);
	}
	return $filename;
}

/**
 * Delete an image from uploads directory
 * @param string $image
 */
function deleteImage($image, $uploadDirectory)
{	
	// Como la imagen está en el último elemento del vector, quitar el \n
	$image = str_replace("\r", "", $image);
	$image = str_replace("\n", "", $image);
	unlink($uploadDirectory . "/" . $image);
}

/**
 * Delete user from file and image from directory
 * @param int $id User id
 */
function deleteUserFile($id, $filename, $uploadDirectory)
{
	$arrayUser = readUser($id, $filename);
	// La imagen es el último elemento del array
	
	$image = $arrayUser[10];
	
	// Borrar la imagen del directorio
	deleteImage($image, $uploadDirectory);
	
	// Borrar el usuario con ese id
	$arrayUsers = readUsersFromFile($filename);
	unset($arrayUsers[$id]);
	
	// Convertir el array en string y reescribir el fichero txt
	$textUsers = implode("\r\n", $arrayUsers);
	file_put_contents($filename, $textUsers);
}