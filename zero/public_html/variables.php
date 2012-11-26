<?php

define ("NOMBRE", "Caballero");
$nombre = "María Berenguer ";

echo $nombre;
echo NOMBRE;

// Control de errores: la @ hace que no se muestren los warning por pantalla
@include('cosa.php');

$var1="María";
$var2="FALSE";	// Esto es un string, no es booleano

$alumno=array('María', 'Berenguer', 'mariaberen');

// Preguntar qué tipo de variable es
//var_dump($var1);
//var_dump($var2);
// En tipos compuestos, este var_dump muestra la variable toda en una línea,
// es difícil de leer si es un tipo de dato complejo
echo "<br/>";
var_dump($alumno);

// <pre> es un tag de html que muestra la variable con formato predefinido
echo "<pre>";
print_r($alumno);
var_dump($alumno);
// $_SERVER es un array asociativo, al que cada elemento del array se le asocia
// una cadena como "identificador", en vez de un índice numérico
print_r($_SERVER);
echo "</pre>";

