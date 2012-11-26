<?php
// Definir un array numérico
$alumno=array("María", "Berenguer", "mariaberen");
// Definir un array asociativo
$alumno2=array("nombre"=>"María", 
		"apellido"=>"Berenguer", 
		"email"=>"mariaberen");

// Un foreach recorre un array; también recorre un objeto
// $key es la llave para recorrer el array u objeto
foreach ($alumno as $key => $value) {
	echo "esto es key: ".$key;
	echo "<br/>";	// Tag html de salto de línea
	echo "esto es value: ".$value;
	echo "<hr/>";	// Tag html con línea horizontal
}

echo "<hr/>";

foreach ($alumno2 as $key => $value) {
	echo "esto es key: ".$key;
	echo "<br/>";	// Tag html de salto de línea
	echo "esto es value: ".$value;
	echo "<hr/>";	// Tag html con línea horizontal
}