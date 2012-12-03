<!DOCTYPE html>
<html lang="en">
<head>
<title>Formulario</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Tablero Tic Tac Toe">
<meta name="keywords" content="TicTacToe,Web,PHP">
<meta charset="UTF-8" />
</head>
<body>
<?php 
$winner = $params['win'];
?>
Tres en Raya
<br/>
<input type="submit" name="submit" value="Play again"/>
<br/>
<?= ($winner == 'X')?'Mala suerte, te han ganado!':'Enhorabuena, has ganado!'?>
</body>
</html>