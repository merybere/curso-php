<!-- Añadir el ancla a agregar un nuevo elemento a través del formulario -->
<a href="?action=insert">Agregar</a>

<!-- Cabeceras de la tabla -->
<table cellpadding=5 border=1 >
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>password</th>
		<th>description</th>
		<th>pet</th>
		<th>city</th>
		<th>code</th>
		<th>languajes</th>
		<th>submit</th>
		<th>photo</th>
		<th>action</th>
	</tr>

	<!-- Dibujar la tabla -->
	
	<!-- Dividir las líneas por columnas -->
	<?php foreach($arrayUsers as $key => $users): ?>
		<tr>
		<?php
		$user = explode("|", $users);
		foreach ($user as $value):
		?>
			<td>
			<!-- short tag para hacer un echo -->
			<?= $value; ?>
			</td>
		<?php endforeach;?>
		<td>
		<!-- Añadir las anclas a editar filas. Para editar una fila, necesitas
		     el número de línea en la que está el dato que se quiere cambiar -->
		<a href="?action=update&id=<?= $key; ?>">Editar</a>
		<!-- Añadir las anclas a borrar filas -->
		<a href="?action=delete&id=<?= $key; ?>">Borrar</a>
		</tr>
	<?php endforeach;?>
</table>
