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
 * Write to file
 * Cargar en un fichero .txt todos los datos del formulario, cada elemento
 * del formulario en una línea. Si un elemento es un array, separar cada ítem
 * por pipes (|) en una misma línea. Cada vez que se carguen datos nuevos en
 * el formulario, añadirlos al mismo fichero.
 * @param string $imageName Image name
 * @param string $filename
 */
function writeToFile($arrayGame, $filename) 
{	
	$textGame = implode("\r\n", $arrayGame);
	
	// Rellenar el fichero con los contenidos; si el fichero existe, con FILE_APPEND
	// añadimos un nuevo texto al final
	file_put_contents($filename, $textGame);
}

/**
 * read game from file
 * @return array: Game array
 */
function readGameFromFile($filename)
{
	
	$arrayGame = array();
	if(file_exists($filename)) 
	{
		// Extraer los datos de un fichero en un string
		$gameText = file_get_contents($filename);
	
		// Dividir el string por líneas
		$arrayGame = explode("\r\n", $gameText);
	}
	return $arrayGame;
}


/**
 * Init array to null
 * @return array: User array
 */
function initArrayGame()
{
	$arrayGame = array();
	for ($i = 0; $i < 3; $i++) 
	{
		$arrayGame[$i] = '_|_|_';
	}
	return $arrayGame;
}

/**
 * Update the game at elem in (row,col)
 * @param int $row
 * @param int $col
 * @param char $player
 * @param string $filename
 */
function updateToFile($row, $col, $player, $filename)
{
	$arrayGame = readGameFromFile($filename);
	$arrayLine = explode('|', $arrayGame[$row]);
	$arrayLine[$col] = $player;
	$textLine = implode('|', $arrayLine);
	$arrayGame[$row] = $textLine;
	writeToFile($arrayGame, $filename);
}

/**
 * 
 * @param string $filename
 */
function playMachine($filename)
{
	$arrayGame = readGameFromFile($filename);
	for ($i = 0; $i < 3; $i++)
	{
		$arrayGame[$i] = explode('|', $arrayGame[$i]);
	}
	
	$fil = rand(0, 2);
	$col = rand(0, 2);
	while ($arrayGame[$fil][$col] != '_')
	{
		$fil = rand(0, 2);
		$col = rand(0, 2);
	}
	updateToFile($fil, $col, 'X', $filename);
}

/**
 * 
 * @param string $filename
 * @return string: winner
 */
function checkWinner($filename)
{
	$arrayGame = readGameFromFile($filename);
	for ($i = 0; $i < 3; $i++)
	{
		$arrayGame[$i] = explode('|', $arrayGame[$i]);
	}
	
	$i = 0;
	while ($i < 3)
	{				
		if ($arrayGame[$i][0] <> '_' && ($arrayGame[$i][0] == $arrayGame[$i][1]) && ($arrayGame[$i][0] == $arrayGame[$i][2]))
			return $arrayGame[$i][0];
		
		if ($arrayGame[0][$i] <> '_' && ($arrayGame[0][$i] == $arrayGame[1][$i]) && ($arrayGame[0][$i] == $arrayGame[2][$i]))
			return $arrayGame[0][$i];
   
		$i++;
	}
	
	if ($arrayGame[0][0] <> '_' && ($arrayGame[0][0] == $arrayGame[1][1]) && ($arrayGame[0][0] == $arrayGame[2][2]))
		return $arrayGame[0][0];
	
	if ($arrayGame[0][2] <> '_' && ($arrayGame[0][2] == $arrayGame[1][1]) && ($arrayGame[0][2] == $arrayGame[2][0]))
		return $arrayGame[0][2];
	
	return '_';
}

function resetGame($filename)
{
	unlink($filename);
}
