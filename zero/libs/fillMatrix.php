<?php
// Función que rellena tantas casillas de la matriz como indica el parámetro
// $item con el carácter *; se hace con casillas aleatorias
function fillMatrix($matrix, $fil, $col, $items) {

	$num_items = 0;
	
	while ($num_items < $items) {
		$elem = randCas($fil - 1, $col - 1);
		if ($matrix[$elem["fil"]][$elem["col"]] == 0) {
			$matrix[$elem["fil"]][$elem["col"]] = '*';
			$num_items++;
		}
	}
	
	return $matrix;
}

// Función que escoge una casilla aleatoria entre el rango ($fil, $col)
function randCas($fil, $col) {
	$cas = array(
			"fil" => rand(0, $fil),
			"col" => rand(0, $col)
	);
	return $cas;
}