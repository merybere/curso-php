<?php
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
	for ($i = 0; $i < 4; $i++)
	{
		$textLine = implode('|', $arrayGame[$i]);
		$arrayGame[$i] = $textLine;
	}

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
	for ($i = 0; $i < 4; $i++)
	{
		$arrayGame[$i] = explode('|', $arrayGame[$i]);
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
	for ($i = 0; $i < 4; $i++) 
	{
		for ($j = 0; $j < 4; $j++){
			$arrayGame[$i][$j] = '_';
		}
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
function updateToFile($col, $player, $filename)
{
	$arrayGame = readGameFromFile($filename);
	
	
	$fil = 3;
	while (($arrayGame[$fil][$col] <> '_') && $fil > 0)
		$fil--;
	$arrayGame[$fil][$col] = $player;
	
	writeToFile($arrayGame, $filename);
}

/**
 * Returns the first file with an empty bock
 * @param int $col
 * @param array $arrayGame
 * @return int
 */
function firstEmpty($col, $arrayGame)
{
	$fil = 3;
	while (($arrayGame[$fil][$col] <> '_') && $fil > 0)
		$fil--;
	
	if ($arrayGame[$fil][$col] <> '_')
		return -1;
	else 
		return $fil;
}

/**
 * Returns the first file with an empty bock
 * @param int $col
 * @param array $arrayGame
 * @return int
 */
function isEmpty($col, $filename)
{
	$arrayGame = readGameFromFile($filename);
	
	$fil = firstEmpty($col, $arrayGame);

	if ($fil == -1)
		return FALSE;
	else
		return TRUE;
}

/**
 * 
 * @param string $filename
 */
function playMachine($filename)
{
	$arrayGame = readGameFromFile($filename);
	
	$col = rand(0, 3);
	$fil = firstEmpty($col, $arrayGame);

	while ($arrayGame[$fil][$col] != '_')
	{
		$col = rand(0, 3);
		$fil = firstEmpty($col, $arrayGame);
	}
	updateToFile($col, 'X', $filename);
}

/**
 * 
 * @param string $filename
 * @return string: winner
 */
function checkWinner($filename)
{
	$arrayGame = readGameFromFile($filename);
	
	$i = 0;
	while ($i < 4)
	{				
		if ($arrayGame[$i][0] <> '_' && 
				($arrayGame[$i][0] == $arrayGame[$i][1]) && 
				($arrayGame[$i][0] == $arrayGame[$i][2]) &&
				($arrayGame[$i][0] == $arrayGame[$i][3]))
			return $arrayGame[$i][0];
		
		if ($arrayGame[0][$i] <> '_' && 
				($arrayGame[0][$i] == $arrayGame[1][$i]) && 
				($arrayGame[0][$i] == $arrayGame[2][$i]) &&
				($arrayGame[0][$i] == $arrayGame[3][$i]))
			return $arrayGame[0][$i];
   
		$i++;
	}
	
	if ($arrayGame[0][0] <> '_' && 
			($arrayGame[0][0] == $arrayGame[1][1]) && 
			($arrayGame[0][0] == $arrayGame[2][2]) &&
			($arrayGame[0][0] == $arrayGame[3][3]))
		return $arrayGame[0][0];
	
	if ($arrayGame[0][3] <> '_' && 
			($arrayGame[0][3] == $arrayGame[1][2]) && 
			($arrayGame[0][3] == $arrayGame[2][1]) &&
			($arrayGame[0][3] == $arrayGame[3][0]))
		return $arrayGame[0][3];
	
	return '_';
}

function resetGame($filename)
{
	if (file_exists($filename))
		unlink($filename);
}
