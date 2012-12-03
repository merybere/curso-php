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
$arrayGame = $params['arrayGame'];
?>
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
			<td>
			<!-- short tag para hacer un echo -->
			<a href="?action=update&row=<?= $i; ?>&col=<?= $j; ?>">
				<?= $casillas[$j]; ?>
			</a>
			</td>
		<?php endfor;?>
		</tr>
	<?php endfor;?>
</table>
</body>
</html>