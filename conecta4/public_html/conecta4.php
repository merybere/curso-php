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
			if (isEmpty($_GET['col'], $config['filename']))
			{
				updateToFile($_GET['col'], 'O', $config['filename']);
				$win = checkWinner($config['filename']);
				if ($win <> '_')
				{
					header("Location: conecta4.php?action=tablero&win=" . $win);
					exit();
				}
				
				playMachine($config['filename']);
				$win = checkWinner($config['filename']);
				if ($win <> '_')
				{
					header("Location: conecta4.php?action=tablero&win=" . $win);
					exit();
				}
			}
			header("Location: conecta4.php?action=tablero");
			exit();
		}
		break;	

	case 'tablero':	// Mostrar la tabla (url + ?action=select)
		if ($_POST)
		{
			switch ($_POST['submit'])
			{
				case "Play again":
					resetGame($config['filename']);
					header("Location: conecta4.php?action=tablero");
					exit();
					break;
					
				case "1":
					header("Location: conecta4.php?action=update&col=0");
					exit();
					break;
					
				case "2":
					header("Location: conecta4.php?action=update&col=1");
					exit();
					break;

				case "3":
					header("Location: conecta4.php?action=update&col=2");
					exit();
					break;

				case "4":
					header("Location: conecta4.php?action=update&col=3");
					exit();
					break;
						
				default:
					break;
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

