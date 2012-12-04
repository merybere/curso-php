<!DOCTYPE html>
<html lang="en">
<head>
<title>Tic Tac Toe</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Tablero Tic Tac Toe">
<meta name="keywords" content="TicTacToe,Web,PHP">
<meta charset="UTF-8" />
</head>
<body>
<?php 
$arrayGame = $params['arrayGame'];
$winner = $params['win'];
?>
<form method="POST">
	Tres en Raya
	<table cellpadding=15 border=1 >
	
		<!-- Dibujar la tabla -->
		
		<!-- Dividir las líneas por columnas -->
		<?php for ($i=0; $i < 3; $i++): ?>
			<tr>
			<?php
			$casillas = explode("|", $arrayGame[$i]);
			for ($j=0; $j < 3; $j++):
			?>
				<td align="center" height="20">
				<?php if($casillas[$j] == '_' && $winner == '_'):?>
				<a href="?action=update&row=<?= $i; ?>&col=<?= $j; ?>">
					<?= $casillas[$j]; ?>
				</a>
				<?php else: echo $casillas[$j];?>
				<?php endif;?>
				</td>
			<?php endfor;?>
			</tr>
		<?php endfor;?>
	</table>
	<input type="submit" name="submit" value="Play again"/>
	<br/>
	<?php if($winner == 'X'):?>
		Mala suerte, te han ganado!
	<?php endif;?>
	<?php if($winner == 'O'):?>
		Enhorabuena, has ganado!
	<?php endif;?>	
</form>
</body>
</html>