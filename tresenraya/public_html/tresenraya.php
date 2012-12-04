<?php
// CONTROLADOR
// echo "<pre>Post: ";
// print_r($_POST);
// echo "</pre>";

// echo "<pre>Get: ";
// print_r($_GET);
// echo "</pre>";

// echo "<pre>Post: ";
// print_r($_FILES);
// echo "</pre>";

require_once '../application/models/gameModel.php';
require_once '../application/models/applicationModel.php';
require_once '../application/models/debugModel.php';

// Lectura del fichero de configuración
$configFile = '../application/configs/config.ini';
$context = 'production';
$config = readConfig($configFile, $context);

// $action se saca de una variable que pasa por el _GET
if (isset($_GET['action']))
	$action=$_GET['action'];
else
	// Acción por defecto
	$action='tablero';

// Switch para tratar las posibles acciones. 
switch ($action)
{
	case 'update':
		if (!$_POST) 
		{	
			updateToFile($_GET['row'], $_GET['col'], 'O', $config['filename']);
			$win = checkWinner($config['filename']);
			if ($win <> '_')
			{
				header("Location: tresenraya.php?action=tablero&win=" . $win);
				exit();
			}
			
			playMachine($config['filename']);
			$win = checkWinner($config['filename']);
			if ($win <> '_')
			{
				header("Location: tresenraya.php?action=tablero&win=" . $win);
				exit();
			}
			
			header("Location: tresenraya.php?action=tablero");
			exit();
		}
		break;	

	case 'tablero':	// Mostrar la tabla (url + ?action=select)
		if ($_POST)
		{
			if($_POST['submit'] == "Play again")
			{
				resetGame($config['filename']);
				header("Location: tresenraya.php?action=tablero");
				exit();
			}
		}
		else 
		{
			if (file_exists($config['filename']))
			{
				$arrayGame = readGameFromFile($config['filename']);
			}
			else
			{
				$arrayGame = initArrayGame();
				writeToFile($arrayGame, $config['filename']);
			}

			if (isset($_GET['win']))
				$win = $_GET['win'];
			else
				$win = '_';
			$params = array('arrayGame' => $arrayGame, 'win' => $win);
			include("../application/views/tablero.php");
		}
		break;		
		
	default:
		break;
}

