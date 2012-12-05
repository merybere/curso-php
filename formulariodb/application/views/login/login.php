<?php 
$arrayUser = $params['arrayUser'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>The New York Times - Breaking News, World News &amp; Multimedia</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Formulario web">
<meta name="keywords" content="Formulario,Web,PHP">
<meta charset="UTF-8" />
</head>
<body>
<!-- Hay que controlar acciones diferentes, según si vienes a insertar uno
     nuevo o actualizar uno diferente. Si no ponemos en el form la propiedad
     action="?action=insert", formulario se envia a la url de la que viene. -->
<form method="POST">
	<ul>

		<li>
			Email:
			<input type="text" name="email" value="<?=$arrayUser['email'];?>"/>
		</li>
		<li>
			Password:
			<input type="password" name="password"/>
		</li>

		<li>
			Submit: 
			<input type="submit" name="submit"/>
		</li>

	</ul>
</form>
</body>
</html>
