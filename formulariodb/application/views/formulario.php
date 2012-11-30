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
<form method="POST"
	enctype="multipart/form-data">
	<ul>
		<li>
			Id:
			<input type="hidden" name="id" value="<?=$arrayUser['iduser'];?>" />
		</li>
		<li>
			Nombre:
			<input type="text" name="name" value="<?=$arrayUser['name'];?>"/>
		</li>
		<li>
			Email:
			<input type="text" name="email" value="<?=$arrayUser['email'];?>"/>
		</li>
		<li>
			Password:
			<input type="password" name="password"/>
		</li>
		<li>
			Descipción:
			<textarea rows="6" cols="6" name="description">
				<?=$arrayUser['description'];?>
			</textarea>
		</li>
		<li>
			Mascotas:
			<select multiple name="pet[]">
				<option value="cat" 
					<?=(strpos($arrayUser['pets'],'cat')===FALSE)?'':'selected'; ?> >
					Gato
				</option>
				<option value="dog" 
					<?=(strpos($arrayUser['pets'],'dog')===FALSE)?'':'selected'; ?> >
					Perro
				</option>
				<option value="tiger" 
					<?=(strpos($arrayUser['pets'],'tiger')===FALSE)?'':'selected'; ?> >
					Tigre
				</option>
			</select>
		</li>
		<li>
			Ciudad:
			<select name="city">
				<option value="zrg" 
					<?=($arrayUser['city']=='zrg')?'selected':'';?> >
					Zaragoza
				</option>
				<option value="bcn" 
					<?=($arrayUser['city']=='bcn')?'selected':'';?> >
					Barcelona
				</option>
				<option value="blb" 
					<?=($arrayUser['city']=='blb')?'selected':'';?> >
					Bilbao
				</option>
			</select>
		</li>
		<li>
			Lenguaje: 
			Java
				<input type="radio" name="coder" value="java" 
					<?=($arrayUser['coders']=='java')?'checked':'';?>/>
			php		
				<input type="radio" name="coder" value="php" 
					<?=($arrayUser['coders']=='php')?'checked':'';?>/>
		</li>
		<li>
			Idiomas: 
			Inglés		
				<input type="checkbox" name="languages[]" value="en" 
					<?=(strpos($arrayUser['languages'],'en')===FALSE)?'':'checked'; ?>/>
			Castellano	
				<input type="checkbox" name="languages[]" value="es" 
					<?=(strpos($arrayUser['languages'],'es')===FALSE)?'':'checked'; ?>/>
		</li>
		<li>
			Foto: 
			<input type="file" name="photo"/>
			<?php if(isset($arrayUser['photo'])):?>
			<img src="uploads/<?=$arrayUser['photo'];?>" style="width:150px;"/>
			<?php endif;?>
		</li>
		<li>
			Submit: 
			<input type="submit" name="submit"/>
		</li>
		<li>
			Reset: 
			<input type="reset" name="reset"/>
		</li>
	</ul>
</form>
</body>
</html>
