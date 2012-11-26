<?php

function countMatrix($matrix, $fil, $col) {
	
	for($i = 0; $i < $fil; $i++) {
		for($j = 0; $j < $col; $j++) {
			if($matrix[$i][$j] == "0") {
				
				$matrix = countElems($matrix, $i, $j, $fil, $col);
			}
		}
	}
	return $matrix;
}



function countElems($matrix, $f, $c, $fil, $col) {

	if($f > 0) {
		if($c > 0) {
			$matrix[$f][$c] += isElem($matrix, $f-1, $c-1);
		}
		$matrix[$f][$c] += isElem($matrix, $f-1, $c);
		if($c < $col-1) {
			$matrix[$f][$c] += isElem($matrix, $f-1, $c+1);
		}
	}

	if($c > 0) {
		$matrix[$f][$c] += isElem($matrix, $f, $c-1);
	}
	if($c < $col-1) {
		$matrix[$f][$c] += isElem($matrix, $f, $c+1);
	}

	if($f < $fil-1) {
		if($c > 0) {
			$matrix[$f][$c] += isElem($matrix, $f+1, $c-1);
		}
		$matrix[$f][$c] += isElem($matrix, $f+1, $c);
		if($c < $col-1) {
			$matrix[$f][$c] += isElem($matrix, $f+1, $c+1);
		}
	}
	return $matrix;
}

function isElem($matrix, $f, $c) {
	
	if ($matrix[$f][$c] == '*') {
		return 1;
	} else {
		return 0;
	}
}