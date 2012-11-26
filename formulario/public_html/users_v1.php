<?php

$filename = "users.txt";

// Extraer los datos de un fichero en un string
$usersText = file_get_contents($filename);

/* echo "<pre>";
echo print_r($usersText);
echo "</pre>"; */
		
// Dividir el string por líneas
$arrayusers = explode("\n", $usersText);

// Añadir el ancla a agregar un nuevo elemento a través del formulario
echo "<a href=\"formulario.php\">Agregar</a>";

// Cabeceras de la tabla
echo "<table border=1>";
	echo "<tr>";
		echo "<th>id</th>";
		echo "<th>name</th>";
		echo "<th>email</th>";
		echo "<th>password</th>";
		echo "<th>description</th>";
		echo "<th>pet</th>";
		echo "<th>code</th>";
		echo "<th>languaje</th>";
		echo "<th>submit</th>";
		echo "<th>photo</th>";
		echo "<th>action</th>";
	echo "</tr>";

	// Dibujar la tabla

	// Dividir las líneas por columnas
	foreach($arrayusers as $users) {
		echo "<tr>";
		$user = explode("|", $users);
		foreach ($user as $value) {
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		// Añadir las anclas a editar y borrar filas
		// (de momento no llevan a ningún sitio)
		echo "<a href=\"#\">Editar</a>";
		echo " ";
		echo "<a href=\"#\">Borrar</a>";
		echo "</tr>";
	}
echo "</table>";


