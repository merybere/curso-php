<?php

class Models_usersDbModel
{
	protected $config;
	protected $cnx;
	
	public function __construct($config)
	{
		$this->config = $config;
		// Instancia de la BD leyéndola del registro de la sesión
		$this->cnx = $_SESSION['register']['db'];
	}
	
	/**
	 * Upload image
	 * Para subir una imagen puedo usar esa función sin necesidad de un objeto,
	 * por eso la declaro como estática.
	 * @param array $_FILES Array FILES
	 * @return string Image final name
	 */
	public static function uploadImage($_FILES, $config)
	{
		$destination = $config['uploadDirectory'] . "/" . $_FILES['photo']['name'];
		$filename = $_FILES['photo']['tmp_name'];
		$path_parts = pathinfo($destination);
		$name = $path_parts['filename'] . "." . $path_parts['extension'];
		$i = 0;
		while(in_array($name, scandir($config['uploadDirectory'])))
		{
			$i++;
			$name = $path_parts['filename'] . "_" . $i .
					"." . $path_parts['extension'];
		}
		$destination = $config['uploadDirectory'] . "/" . $name;
		move_uploaded_file($filename, $destination);
		return $name;
	}
	
	/**
	 * Update user image
	 * @param array $_FILES Files array
	 * @param int $id User id
	 */
	public function updateImage($_FILES, $id)
	{
		$arrayUser = $this->readUser($id);
		$image = $arrayUser[10];
		// 	Si FILES nueva
		if(isset($_FILES['photo']['name']))
		{
			// 		borrar imagen
			$image = str_replace("\r", "", $image);
			$image = str_replace("\n", "", $image);
			unlink($this->config['uploadDirectory'] . "/" . $image);
			// 		subir imagen nueva
			$image = $this->uploadImage($_FILES);
				
		}
		// 	de lo contrario
		else
		{
			// 		no borrar nada
		}
		// 	devolver imagen
		return $image;
	}
	
	/**
	 * Inicializa el array de usuarios
	 * @return array Users array
	 */
	public function initArrayUser()
	{
		$arrayUser = array();
		for ($i = 0; $i < 11; $i++)
			$arrayUser[$i] = NULL;
			return $arrayUser;
	}
	
	public function readUsers()
	{
		$sql = "SELECT iduser, name, email, password, description, photo,
				       coders, city
				FROM   users, cities
				WHERE  users.cities_idcity = cities.idcity;";
		$arrayUsers = $this->cnx->query($sql);
		foreach($arrayUsers as $key => $user)
		{
			$arrayUsers[$key]['pets'] = implode(',',
										$this->readUserPets($user['iduser']));
			$arrayUsers[$key]['languages'] = implode(',',
										$this->readUserLanguages($user['iduser']));
		}
		
		return $arrayUsers;
		
	}
	public function readUserPets($id)
	{
		$pets = array();
		$sql = "SELECT pet
				FROM users
				LEFT JOIN users_has_pets
				ON users.iduser=users_has_pets.users_iduser
				LEFT JOIN pets
				ON users_has_pets.pets_idpet=pets.idpet
				WHERE iduser=".$id;
		
		$arrayPets = $this->cnx->query($sql);
		foreach ($arrayPets as $pet)
			$pets[] = $pet['pet'];
		
		return $pets;
	}
	
	public function readUserLanguages($id)
	{
		$languages = array();
		$sql = "SELECT language
				FROM users
				LEFT JOIN users_has_languages
				ON users.iduser = users_has_languages.users_iduser
				LEFT JOIN languages
				ON users_has_languages.languages_idlanguage=languages.idlanguage
				WHERE iduser = ".$id;
		
		$arrayLanguages = $this->cnx->query($sql);
		foreach ($arrayLanguages as $language)
			$languages[] = $language['language'];
		
		return $languages;
	}
	
	public function readUser($id)
	{
		$sql = "SELECT * FROM users WHERE iduser = " . $id;
		$arrayUser = $this->cnx->query($sql);
		
		return $arrayUser[0];
	}
	
	public function insertUser($arrayData, $imageName)
	{
		$sql = "INSERT INTO users SET 
				name = '" . $arrayData['name']."',
				email = '" . $arrayData['email']."',
				cities_idcity = '" . $arrayData['city']."',
				description = '" . $arrayData['description']."',
				password = '" . $arrayData['password'] . "',			
				coders = '" . $arrayData['coder'] . "',
				photo = '" . $imageName . "'
			";
		$this->cnx->query($sql);
		$sql = "SELECT LAST_INSERT_ID() as id";
		$array = $this->cnx->query($sql);
		$id = $array[0]['id'];
		
		foreach($arrayData['pets'] as $pets)
		{
			$sql = "INSERT INTO users_has_pets SET
					users_iduser = ".$id.",
					pets_idpet = ".$pets['id'];
			$this->cnx->query($sql);
		}
		
		foreach($arrayData['languages'] as $languages)
		{
			$sql = "INSERT INTO users_has_languages SET
					users_iduser = " . $id . ",
					languages_idlanguage = " . $languages['id'];
			$this->cnx->query($sql);
		}
		
		return $id;
	}
	
	public function updateUser($arrayData, $id)
	{
		return $numRows;
	}
	
	public function deleteUser($id)
	{
		return $numRows;
	}
	
	public function readPets()
	{
		$sql = "SELECT idpet AS id, pet AS value
			    FROM pets";
		$arrayPets = $this->cnx->query($sql);
		return $arrayPets;
	}
	
	public function readLanguages()
	{
		$sql = "SELECT idlanguage AS id, language AS value
			    FROM languages";
		$arrayLanguages = $this->cnx->query($sql);
		return $arrayLanguages;
	}
	
	public function readCoders()
	{
		//FIXME: Normalizar las tablas
		
		$sql = "SELECT coder AS id, coder AS value
			    FROM coders";
		$arrayCoders = $this->cnx->query($sql);
		return $arrayCoders;
	}
	
	public function readCities()
	{
		$sql = "SELECT idcity AS id, city AS value
			    FROM cities";
		$arrayCities = $this->cnx->query($sql);
		return $arrayCities;
	}

}