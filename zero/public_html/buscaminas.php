<?PHP

include "../libs/initMatrix.php";
include "../libs/showMatrix.php";
include "../libs/fillMatrix.php";
include "../libs/countMatrix.php";
		
$fil = 10;
$col = 10;
$max_mines = ($fil * $col) / 2;

$buscaminas = initMatrix($fil, $col);
showMatrix($buscaminas, $fil, $col);
echo "<hr/>";
$buscaminas = fillMatrix($buscaminas, $fil, $col, $max_mines);
showMatrix($buscaminas, $fil, $col);
echo "<hr/>";
$buscaminas = countMatrix($buscaminas, $fil, $col);
showMatrix($buscaminas, $fil, $col);



