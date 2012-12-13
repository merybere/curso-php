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
	if ($_FILES['photo']['name'] == '')
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
function writeToDriveFile($client, $userData, $imageName, $filekey) 
{	

	// Para cada elemento de $_POST, si el elemento es un array, hacer un implode
	// separado por pipes
	foreach($userData as $key => $value) 
	{
		if(is_array($value)) 
		{
			// Convertir el array en una sola string, separada por comas
			$value = implode(',', $value);
		}
		// Añadir cada valor a un vector
		$arrayUser[$key] = $value;
	}
	
	$service = new Zend_Gdata_Spreadsheets($client);
	
	if($userData['iduser'] == null)
	{
		$query = new Zend_Gdata_Spreadsheets_ListQuery();
		$query->setSpreadsheetKey($filekey);
		$listFeed = $service->getListFeed($query);
		
		// get and delete last row
		$lastRow = $listFeed->entries[$listFeed->count()-1]->getCustom();
		$lastid = $lastRow[0]->getText();

		$arrayUser['iduser'] = $lastid + 1;
	}
		
		
	// Agregar la foto
	$arrayUser['photo'] = $imageName;
	
	
	$service->insertRow($arrayUser, $filekey);
}

/**
 * read users from Google Drive
 * @param string $filename
 * @return array: Users array
 */
function readUsersFromDrive($client, $key)
{
	
	$arrayUsers = array();
	
	$spreadsheetService = new Zend_Gdata_Spreadsheets($client);
    $query = new Zend_Gdata_Spreadsheets_ListQuery();
    $query->setSpreadsheetKey($key);
    $listFeed = $spreadsheetService->getListFeed($query);
	foreach($listFeed->entries as $key => $row) 
	{
		foreach($row->getCustom() as $column)
			$arrayUsers[$key][$column->getColumnName()] = $column->getText();
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
function readUser($id, $filename)
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
	$arrayUser = array('iduser' => null,
					'name' => null,
					'email' => null,
					'password' => null,
					'description' => null,
					'pets' => null,
					'city' => null,
					'codes' => null,
					'languages' => null,
					'submit' => null,
					'photo' => null
			);

	return $arrayUser;
}

/**
 * Update the user at line id
 * @param string $imageName
 * @param int $id
 * @param string $filename
 */
function updateToDriveFile($client, $imageName, $iduser, $key)
{
	$arrayUsers = readUsersFromDrive($client, $filekey);
	
	foreach($arrayUsers as $key => $value) 
	{
		if(is_array($value)) 
		{
			// Convertir el array en una sola string, separada por comas
			$value = implode(',', $value);
		}
		// Añadir cada valor a un vector
		$arrayUser[$key] = $value;
	}
	
	// Añadir la imagen como último elemento del array de datos del usuario
	$arrayUser[] = $imageName;

	// Agregar la foto
	$arrayUser['photo'] = $imageName;
	
	$service = new Zend_Gdata_Spreadsheets($client);
	$query = new Zend_Gdata_Spreadsheets_CellQuery();
	$query->setSpreadsheetKey($key);
	$query->setSpreadsheetQuery('iduser = ' . $iduser);
	$cellFeed = $service->getListFeed($query);
	$service->updateRow($cellFeed, $arrayUser);
}

/**
 * Update user image
 * @param array $_FILES Files array
 * @param int $id User id
 * @param string $filename File with users
 * @param $uploadDirectory location of the images
 * @return string: image
 */
function updateImageDrive($_FILES, $id, $filename, $uploadDirectory)
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
function deleteUser($id, $filename, $uploadDirectory)
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