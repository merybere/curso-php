<?php


function readUsers($cnx)
{
	$sql = "SELECT iduser, name, email, password, description, photo, coders, city
			FROM users
			INNER JOIN cities ON
				cities.idcity = users.cities_idcity;";
	$arrayUsers = query($sql, $cnx);
	foreach ($arrayUsers as $key => $value)
	{
		array_push($value, readPetsFromUser($value['idUser'], $cnx));
		
	}
	return $arrayUsers;
}

function readPetsFromUser($idUser, $cnx)
{
	$sql = "SELECT group_concat(pet)
			FROM users_has_pets uhp, pets
			WHERE uhp.users_iduser = " . $idUser . " AND
				  uhp.pets_idpet = pets.idpet;";
	$pets = query($sql, $cnx);
	
	return $pets;
}

/**
 * Read user data from db
 * @param int $id user id to read
 * @param resource $cnx connection db link
 * @return array: data user
 */
function readUser($id, $cnx)
{
	
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
	
	return $numRows;
}