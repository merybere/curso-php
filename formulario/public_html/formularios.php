<!DOCTYPE html>
<html lang = "es">
<head>
	<title>Formularios</title>
	
</head>
<body>
<form
	action=formularios.php 
	method="POST"
	enctype="multipart/form-data">
	<!-- Campo oculto, con un id único que se enviará a la BD al guardar -->
	<input type=hidden name="Id" value="">
	<table>
	<tr>
		<td align="left" width="100">Nombre: </td>
		<td align="center" width="150">
			<input type="text" name="name" maxlength="25" value="">
		</td>
	</tr>
	<tr>
		<td align="left" width="100">Email:	</td>
		<td align="center" width="150">
			<input type="text" name="mail" maxlength="25" value="">
		</td>
	</tr>
	<tr>
		<td align="left" width="100">Password: </td>
		<td align="center" width="150">
			<input type="password" name="password" maxlength="25" VALUE="">
		</td>
	<tr>
	<tr>
		<td align="left" width="100">Descripción: </td>
		<td align="center" width="150">
			<textarea name="description" rows=3 cols=20></textarea>
		</td>
	<!-- Botones -->
	</tr>
		<!-- Botón SUBMIT, envía los datos del formulario -->
		<td>
			<input type = "submit" name="submit" value="Enviar">
		</td>
		<!-- Botón RESET, limpia el formulario de cualquier campo escrito -->
		<td>
			<input type = "reset" name="reset" value="Limpiar">
		</td>
	</table>
</form>
</body>
</html>