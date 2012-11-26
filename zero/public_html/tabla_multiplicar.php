<?php
// Ejercicio: hacer la tabla de multiplicar de dos números cualesquiera
// Ejemplo: 3 x 4
//   1 2 3 4
// 1 1 2 3 4
// 2 2 4 6 8
// 3 3 6 9 12
$a = 3;
$b = 4;

echo "<table>";

for ($i = 0; $i <= $a; $i++) {
	echo "<tr>";
	for ($j = 0; $j <= $b; $j++) {
		switch ($i) {
			case 0:	// Imprimir valor del segundo operando
				if ($j <> 0) {
					echo "<td>" . $j . "</td>";
				} else {
					echo "<td>" . "</td>";
				}
				break;
			default:	// Imprimir el resultado de la multiplicación
				if ($j <> 0) {
					echo "<td>" . ($i * $j) . "</td>";
				} else {	// Imprimir el valor del primer operando
					echo "<td>" . $i . "</td>";;
				}
		}
	}
	echo "</tr>";
}
echo "</table>";