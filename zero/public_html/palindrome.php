<?php
$palindrome = "la ruta nos aporto otro paso natural";

// eliminar los espacios de la cadena
$palChars = array();
$palChars = explode(' ', $palindrome);
$palChars = implode('', $palChars);

echo "<pre>";
print_r($palChars);
echo "</pre>";

$inicio = 0;
$final = strlen($palChars) - 1;
$esPal = TRUE;
while ($esPal && $inicio < $final) {
	
	$esPal = $palChars[$inicio] == $palChars[$final];
	$inicio++;
	$final--;
}

if(!$esPal) {
	echo "NO ";
}
echo "es palíndromo";

// Otra forma sería usar la función strrev, que da la vuelta a una cadena,
// y compararla
$pali=array();
$pali=explode(' ', $palindrome);
$text1=implode('', $pali);
$text2=strrev($text1);

if (strcmp($text1, $text2) == 0) {
	echo "Es palíndrome";
} else {
	echo "No es palíndrome";
}