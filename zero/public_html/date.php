<?php
// Escribir:
// Hoy miércoles, día 315 del año 2012

// Puede dar un error (warning) si no está definida la zona horaria.
// Esto se puede solucionar desde la configuración del zend Server:
// 		localhost/10081
// 		Server Setup --> Directives --> date --> Europe/Madrid
// Otra forma, desde el código:
// 		date_default_timezone_set("Europe/Madrid");

//echo date("\H\o\y l\, \d\í\a z \d\e\l \a\ñ\o Y");
echo "Hoy " . 
	date(l) . 
	", día " . 
	date(z) . 
	" del año " . 
	date(Y);