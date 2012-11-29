<?php
/**
 * Open a connection to MySQL Server
 * @param array $config
 * @return resource: MySQL link identifier if success or FALSE if error
 */
function connect($config)
{
	// Conexión a BD con control de errores
	try
	{
		// Create connection to MYSQL database
		// Fourth true parameter will allow for multiple connections to be made
		$db_connection = mysql_connect ($config['database.server'], 
										$config['database.username'],
										$config['database.password'], 
										true);
		mysql_select_db ($config['database.db']);
		if (!$db_connection)
		{
			// Generación de la excepción con un mensage de error
			throw new Exception('MySQL Connection Database Error: ' . mysql_error());
		}
		else
		{
			$CONNECTED = true;
		}
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	
	return $db_connection;
}

/**
 * 
 * @param unknown_type $cnx
 * @return boolean
 */
function disconnect($cnx)
{
	
	return TRUE;
}

/**
 * 
 * @param unknown_type $cnx
 * @param unknown_type $sql
 * @return unknown
 */
function query($sql, $cnx)
{
	try 
	{
		$result = mysql_query($sql, $cnx);
		if (!$result)
		{
			throw new Exception('MySQL Query Error: ' . mysql_error()); 
		}
		else
		{
			// $result es un record
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				$arrayData[] = $row;
			}
		}
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	return $arrayData;
}