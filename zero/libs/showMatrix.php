<?php
// Función que dibuja los componentes de una matriz por pantalla,
// como una tabla html

function showMatrix($matrix, $fil, $col) {
	echo "<table>";
	for($i = 0; $i < $fil; $i++) {
		echo "<tr>";
		for ($j = 0; $j < $col; $j++) {
			echo "<td>" . $matrix[$i][$j] . "</td>";
		}
		echo"</tr>";
	}
	echo "</table>";
}