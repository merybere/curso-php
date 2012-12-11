<?php 
$arrayUser=$params['arrayUser'];
$arrayDataPets=$params['arrayDataPets'];
$arrayUserPets=$params['arrayUserPets'];
$arrayDataCities=$params['arrayDataCities'];
$arrayUserCities=$params['arrayUserCities'];
$arrayDataCoders=$params['arrayDataCoders'];
$arrayUserCoders=$params['arrayUserCoders'];
$arrayDataLanguages=$params['arrayDataLanguages'];
$arrayUserLanguages=$params['arrayUserLanguages'];

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
<form method="POST"
	enctype="multipart/form-data">
<ul>
<li>
Id:<input type="hidden" name="id" value="1" />
</li>
<li>
Nombre:<input type="text" name="name" value="<?=$arrayUser[1];?>"/>
</li>
<li>
Email:<input type="text" name="email" value="<?=$arrayUser[2];?>"/>
</li>
<li>
Password:<input type="password" name="password"/>
</li>
<li>
Descipcioón:<textarea rows="6" cols="6" name="description"><?=$arrayUser[4];?></textarea>
</li>
<li>
Mascotas:
<?=selectHelper($arrayDataPets, $arrayUserPets, 'pets', TRUE);?>

</li>
<li>
Ciudad:
<?=selectHelper($arrayDataCities, $arrayUserCities, 'city', FALSE);?>

</li>
<li>
Lenguaje: 
<?=checkHelper($arrayDataCoders, $arrayUserCoders, 'coder', FALSE);?>

</li>
<li>
Idiomas: 
<?=checkHelper($arrayDataLanguages, $arrayUserLanguages, 'languages', TRUE);?>

</li>
<li>
Foto: <input type="file" name="photo"/>
	  <?php if(isset($arrayUser[10])):?>
	  	<img src="uploads/<?=$arrayUser[10];?>" style="width:150px;"/>
	  <?php endif;?>
</li>
<li>
Submit: <input type="submit" name="submit"/>
</li>
<li>
Reset: <input type="reset" name="reset"/>
</li>


</ul>
</form>
</body>
</html>
