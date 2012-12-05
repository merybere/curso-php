<?php

/**
 * Autenticate the user
 * @param context $cnx
 * @param array $arrayData data from _POST
 * @return multitype: array of multitype array rows sql result
 */
function loginUser($cnx, $arrayData)
{
	$sql = "SELECT iduser, name
			FROM users
			WHERE email = '" . $arrayData['email'] . "'AND
			      password = '" . $arrayData['password'] . "'";
	
	$user = query($sql, $cnx);
	
	// Garantizar que no hay registros duplicados
	if (count($user) == 1)
	{
		// Guardar en el espacio de la sesión el id del usuario
		$_SESSION['iduser'] = $user[0]['iduser'];
		return TRUE;
	}
	else 
		return FALSE;
}

