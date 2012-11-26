<?php
// Función que inicializa una matriz a espacios vacios
function initMatrix($num_fil, $num_col) {
	
	for($i = 0; $i < $num_fil; $i++) {
		for($j = 0; $j < $num_col; $j++) {
			$matrix[$i][$j] = "0";
		}
	}
	
	return $matrix;
}