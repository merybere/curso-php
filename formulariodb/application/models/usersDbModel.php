<?php

/**
 * 
 * @param context $cnx
 * @return multitype: array of multitype array rows sql result
 */
function readUsers($cnx)
{
	$sql = "SELECT iduser, name, email, password, description, photo, coders, city
			FROM users
			INNER JOIN cities ON
				cities.idcity = users.cities_idcity;";
	
	$arrayUsers = query($sql, $cnx);
	
	// Si la query devuelve 0 quiere decir que no hay resultados de la query
	// Crear un array vacío para devolver en ese caso
	if ($arrayUsers == 0)
		$arrayUsers = array();
	
	foreach ($arrayUsers as $key => $user)
	{
		$arrayUsers[$key]['pets'] = implode(',', readUserPets($user['iduser'], $cnx));
		$arrayUsers[$key]['languages'] = implode(',', readUserLanguages($user['iduser'], $cnx));
	}
	
	return $arrayUsers;
}


/**
 * 
 * @param int $idUser user id to get the pets
 * @param context $cnx
 * @return array multitype
 */
function readPetsFromUser($idUser, $cnx)
{
	$sql = "SELECT group_concat(pet) as pets
			FROM users_has_pets uhp, pets
			WHERE uhp.users_iduser = " . $idUser . " AND
				  uhp.pets_idpet = pets.idpet;";
	$pets = query($sql, $cnx);
	return $pets;
}


function readUserPets($id, $cnx)
{
	$pets = array();
	$sql  = "SELECT pet
		     FROM users
			 LEFT JOIN users_has_pets
			 ON users.iduser = users_has_pets.users_iduser
			 LEFT JOIN pets
			 ON users_has_pets.pets_idpet = pets.idpet
			 WHERE iduser = ".$id;
	$arrayPets = query($sql, $cnx);
	foreach ($arrayPets as $pet)
		$pets[] = $pet['pet'];

	return $pets;
}

function readUserLanguages($id, $cnx)
{
	$languages = array();
	$sql = "SELECT language
			FROM users
			LEFT JOIN users_has_languages
			ON users.iduser = users_has_languages.users_iduser
			LEFT JOIN languages
			ON users_has_languages.languages_idlanguage = languages.idlanguage
			WHERE iduser = ".$id;
			$arrayLanguages = query($sql, $cnx);
	foreach ($arrayLanguages as $language)
		$languages[] = $language['language'];

	return $languages;
}

/**
 *
 * @param int $idUser user id to get the pets
 * @param context $cnx
 * @return array multitype
 */
function readLanguagesFromUser($idUser, $cnx)
{
	$sql = "SELECT group_concat(language) as languages
			FROM users_has_languages uhl, languages
			WHERE uhl.users_iduser = " . $idUser . " AND
				  uhl.languages_idlanguage = languages.idlanguage;";
	$languages = query($sql, $cnx);
	return $languages;
}

/**
 * Read user data from db
 * @param int $id user id to read
 * @param resource $cnx connection db link
 * @return array: data user
 */
function readUser($id, $cnx)
{
	$sql = "SELECT iduser, name, email, password, description, photo, coders, city
			FROM users, cities
			WHERE cities.idcity = users.cities_idcity AND
			      users.iduser = " . $id . ";";
	
	$arrayUsers = query($sql, $cnx);
	$arrayUser = $arrayUsers[0];
	
	$arrayUser['pets'] = implode(',', readUserPets($arrayUser['iduser'], $cnx));
	$arrayUser['languages'] = implode(',', readUserLanguages($arrayUser['iduser'], $cnx));
	
	return $arrayUser;
}

/**
 * Insert new user in db
 * @param array $arrayData user data
 * @param resource $cnx connection db link
 * @return int: las id inserted in db table
 */
function insertUser($arrayData, $cnx, $imageName)
{
	$sql = "INSERT INTO users SET
			name = '".$arrayData['name']."',
			email = '".$arrayData['email']."',
			cities_idcity = '".$arrayData['city']."',
			description = '".$arrayData['description']."',
			password = '".$arrayData['password']."',
			coders = '".$arrayData['coder']."',
			photo = '".$imageName."'
			";
	query($sql, $cnx);
	$sql = "SELECT LAST_INSERT_ID() as id";
	$array = query($sql, $cnx);
	$id = $array[0]['id'];
	
	foreach($arrayData['pets'] as $pets)
	{
		$sql = "INSERT INTO users_has_pets SET
				users_iduser=".$id.",
				pets_idpet=".$pets['id'];
		query($sql, $cnx);
	}
	
	foreach($arrayData['languages'] as $languages)
	{
		$sql = "INSERT INTO users_has_languages SET
				users_iduser = ".$id.",
				languages_idlanguage = ".$languages['id'];
		query($sql, $cnx);
	}
	
	return $id;
}

/**
 * Update user data in db
 * @param array $arrayData user data
 * @param int $id user id to update
 * @param resource $cnx connection db link
 * @return int: num rows affected
 */
function updateUser($arrayData, $id, $cnx)
{
	
	return $numRows;
}

/**
 * Delete user from db
 * @param int $id user id to delete
 * @param resource $cnx connection db link
 * @return int: num rows affected
 */
function deleteUser($id, $cnx)
{
	$sql = "DELETE FROM users
			WHERE users.iduser = " . $id . ";";
	
	$numRows = query($sql, $cnx);
	return $numRows;
}


function readPets($cnx)
{
	$sql = "SELECT idpet AS id, pet AS value
			FROM pets";
	$arrayPets = query($sql, $cnx);
	return $arrayPets;
}
function readLanguages($cnx)
{
	$sql = "SELECT idlanguage AS id, language AS value
			FROM languages";
	$arrayLanguages = query($sql, $cnx);
	return $arrayLanguages;
}
function readCoders($cnx)
{
	//FIXME: Normalizar las tablas

	$sql = "SELECT coder AS id, coder AS value
			FROM coders";
	$arrayCoders = query($sql, $cnx);
	return $arrayCoders;
}
function readCities($cnx)
{
	$sql = "SELECT idcity AS id, city AS value
			FROM cities";
	$arrayCities = query($sql, $cnx);
	return $arrayCities;
}