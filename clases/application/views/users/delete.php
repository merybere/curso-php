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
<form method="POST"
	enctype="multipart/form-data">
	Estas seguro que queires borrar este usuario
<ul>
<li>
Id:<input type="hidden" name="id" value="<?=$_GET['id']?>" />
</li>
<li>
<li>
Submit si: <input type="submit" name="submit" value="si"/>
</li>
<li>
Submit no: <input type="submit" name="submit" value="no"/>
</li>
</ul>
</form>
</body>
</html>
