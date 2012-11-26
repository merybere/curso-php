<?php
// Dado un número, obtener la secuencia de fidonacci hasta ese número,
// separada por comas

$n = 28;
$fib = 0;	// número de fibonacci 0

echo $fib;
$lastFib = $fib;
$fib++;
$index = 1;
$fibo[0] = 0;

while ($fib <= $n) {
	switch ($index) {
		case 1:
			echo ", " . $fib;
			$fibo[1] = 1;
			break;
		default:
			$fibonacci = $fib + $lastFib;
			if ($fibonacci <= $n) {
				echo ", "  . ($fibonacci);
				$lastFib = $fib;
			}
			$fib = $fibonacci;
			$fibo[$index] = $fibonacci;
			break;
	}
	$index++;
}

echo "<pre>";
print_r($fibo);
echo "</pre>";

$text = implode(',', $fibo);
echo $text;