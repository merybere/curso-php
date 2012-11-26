<?php
// Array asociativo normal
$alumno = array(
		'nombre'=>'maría',
		'email'=>'mariaberen',
		'lenguaje'=>'php'
		);

// El valor 99 tendrá una key (ídice) igual a 0 (el primer numérico)
$alumno = array(
		'nombre'=>'maría',
		'email'=>'mariaberen',
		'lenguaje'=>'php',
		99);

// El valor 5 tendrá la key 0 y el valor 99 tendrá la key 1
$alumno = array(
		5,
		'nombre'=>'maría',
		'email'=>'mariaberen',
		'lenguaje'=>'php',
		99);

// El valor 5 desaparece, porque con el FALSE, que tiene un valor 0, se está
// sobreescribiendo la posición 0 del array
$alumno = array(
		5,
		'nombre'=>'maría',
		'email'=>'mariaberen',
		'lenguaje'=>'php',
		FALSE=>'ja',
		99);

// El último valor, ocupará la posición 8. Este array también el válido, y lo
// que hace php es truncar los doubles si se usan como keys
$alumno = array(
		5,
		'nombre'=>'maría',
		'email'=>'mariaberen',
		'lenguaje'=>'php',
		FALSE=>'ja',
		99,
		8.9=>'jejejejeje');


echo $alumno[1];
echo "<pre>";
print_r($alumno);
echo "</pre>";

foreach($alumno as $key => $value)
{
	echo "esto es la key: " . $key;
	echo "<br/>";
	echo "esto es el valor: " . $value;
	echo "<br/>";
}