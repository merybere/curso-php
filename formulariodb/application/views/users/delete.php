<!DOCTYPE html>
<html lang="en">
<head>
<title>Formulario</title>
<meta name="robots" content="noarchive,noodp,noydir">
<meta name="description" content="Formulario web">
<meta name="keywords" content="Formulario,Web,PHP">
<meta charset="UTF-8" />
</head>
<body>
	<form method="POST"
		enctype="multipart/form-data">
		¿Está seguro de que quiere borrar este dato?
		<ul>
			<li>
				Id:<input type="hidden" name="id" value="<?=$_GET['id']?>" />
			</li>
			<li>
				Submit: <input type="submit" name="submit" value="si"/>
			</li>
			<li>
				Submit: <input type="submit" name="submit" value="no"/>
			</li>
		</ul>
	</form>
</body>
</html>