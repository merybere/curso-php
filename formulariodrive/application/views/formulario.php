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
			<input type="hidden" name="id" value="1" />
		</li>
		<li>
			Nombre:
			<input type="text" name="name" value="<?=$arrayUser[1];?>"/>
		</li>
		<li>
			Email:
			<input type="text" name="email" value="<?=$arrayUser[2];?>"/>
		</li>
		<li>
			Password:
			<input type="password" name="password"/>
		</li>
		<li>
			Descipción:
			<textarea rows="6" cols="6" name="description">
				<?=$arrayUser[4];?>
			</textarea>
		</li>
		<li>
			Mascotas:
			<select multiple name="pet[]">
				<option value="cat" 
					<?=(strpos($arrayUser[5],'cat')===FALSE)?'':'selected'; ?> >
					Gato
				</option>
				<option value="dog" 
					<?=(strpos($arrayUser[5],'dog')===FALSE)?'':'selected'; ?> >
					Perro
				</option>
				<option value="tiger" 
					<?=(strpos($arrayUser[5],'tiger')===FALSE)?'':'selected'; ?> >
					Tigre
				</option>
			</select>
		</li>
		<li>
			Ciudad:
			<select name="city">
				<option value="zrg" 
					<?=($arrayUser[6]=='zrg')?'selected':'';?> >
					Zaragoza
				</option>
				<option value="bcn" 
					<?=($arrayUser[6]=='bcn')?'selected':'';?> >
					Barcelona
				</option>
				<option value="blb" 
					<?=($arrayUser[6]=='blb')?'selected':'';?> >
					Bilbao
				</option>
			</select>
		</li>
		<li>
			Lenguaje: 
			Java	<input type="radio" name="coder" value="java" 
						<?=($arrayUser[7]=='java')?'checked':'';?>/>
			php		<input type="radio" name="coder" value="php" 
						<?=($arrayUser[7]=='php')?'checked':'';?>/>
		</li>
		<li>
			Idiomas: 
			Inglés		<input type="checkbox" name="languages[]" value="en" 
							<?=(strpos($arrayUser[8],'en')===FALSE)?'':'checked'; ?>/>
			Castellano	<input type="checkbox" name="languages[]" value="es" 
							<?=(strpos($arrayUser[8],'es')===FALSE)?'':'checked'; ?>/>
		</li>
		<li>
			Foto: 
			<input type="file" name="photo"/>
			<?php if(isset($arrayUser[10])):?>
			<img src="uploads/<?=$arrayUser[10];?>" style="width:150px;"/>
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
