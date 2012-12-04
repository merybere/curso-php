<!DOCTYPE html>
<html lang="en">
<head>
<title>Conecta 4</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Tablero Conecta 4">
<meta name="keywords" content="conecta4,Web,PHP">
<meta charset="UTF-8" />
</head>
<body>
<?php 
$arrayGame = $params['arrayGame'];
$winner = $params['win'];
?>
<form method="POST">
	Conecta 4
	<table cellpadding=15 border=1 >
	
		<!-- Dibujar la tabla -->
		
		<!-- Dividir las líneas por columnas -->
		<?php for ($i=0; $i < 4; $i++): ?>
			<tr>
			<?php
			for ($j=0; $j < 4; $j++):
			?>
				<td align="center" height="20">
				<?php if($arrayGame[$i][$j] <> '_'):?>
					<?=$arrayGame[$i][$j];?>
				<?php endif;?>
				</td>
			<?php endfor;?>
			</tr>
		<?php endfor;?>
		<tr>
			<td>
				<input type="submit" name="submit" 
				<?php if ($winner <> '_'):?>
					disabled="disabled"
				<?php endif;?> 
				value="1"/>
			</td>
			<td>
				<input type="submit" name="submit" 
				<?php if ($winner <> '_'):?>
					disabled="disabled"
				<?php endif;?> 
				value="2"/>
			</td>
			<td>
				<input type="submit" name="submit" 
				<?php if ($winner <> '_'):?>
					disabled="disabled"
				<?php endif;?> 
				value="3"/>
			</td>
			<td>
				<input type="submit" name="submit" 
				<?php if ($winner <> '_'):?>
					disabled="disabled"
				<?php endif;?> 
				value="4"/>
			</td>
		</tr>
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