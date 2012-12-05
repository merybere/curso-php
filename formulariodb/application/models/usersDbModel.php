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
	
	for ($i = 0; $i < count($arrayUsers); $i++)
	{
		$pets = readPetsFromUser($arrayUsers[$i]['iduser'], $cnx);
		$arrayUsers[$i] = array_merge($arrayUsers[$i], $pets[0]);
		
		$languages = readlanguagesFromUser($arrayUsers[$i]['iduser'], $cnx);
		$arrayUsers[$i] = array_merge($arrayUsers[$i], $languages[0]);
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
	
	$pets = readPetsFromUser($arrayUser['iduser'], $cnx);
	$arrayUser = array_merge($arrayUser, $pets[0]);
	
	$languages = readlanguagesFromUser($arrayUser['iduser'], $cnx);
	$arrayUser = array_merge($arrayUser, $languages[0]);
	
	return $arrayUser;
}

/**
 * Insert new user in db
 * @param array $arrayData user data
 * @param resource $cnx connection db link
 * @return int: las id inserted in db table
 */
function insertUser($arrayData, $cnx)
{
	
	return $lastId;
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