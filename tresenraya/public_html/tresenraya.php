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
	$action='select';

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
				header("Location: tresenraya.php?action=winner&win=" . $win);
				exit();
			}
			
			playMachine($config['filename']);
			$win = checkWinner($config['filename']);
			if ($win <> '_')
			{
				header("Location: tresenraya.php?action=winner&win=" . $win);
				exit();
			}
			
			header("Location: tresenraya.php?action=select");
			exit();
		}
		break;	
	case 'winner':
		if ($_POST)
		{
			if($_POST['submit'] == "Play again")
			{
				die('lalala');
				resetGame($config[filename]);
				header("Location: tresenraya.php?action=select");
				exit();
			}
		}
		else 
		{
			$params = array('win' => $_GET['win']);
			include("../application/views/winner.php");
		}
		break;
	case 'select':	// Mostrar la tabla (url + ?action=select)
		if (file_exists($config['filename']))
			$arrayGame = readGameFromFile($config['filename']);
		else
		{
			$arrayGame = initArrayGame();
			writeToFile($arrayGame, $config['filename']);
		}

		$params = array('arrayGame' => $arrayGame);
		include("../application/views/select.php");
		break;		
	default:
		break;
}

