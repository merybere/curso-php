<?php

/**
 * Read config file
 * @param 
 * @param unknown_type $context
 * @return array: Config context array
 */
function readConfig($configFile, $context)
{
	$arrayConfig = array();
	
	// El segundo parámetro es process_sections, para devolver la configuración
	// varios contextos
	$arrayConfig = parse_ini_file($configFile, true);
	
	// Esto nos devuelve un 
 	foreach($arrayConfig as $key =>$value) {
 		if (strpos($key, $context) === FALSE) {
 			$array = $value;
 		}
 	}
 	
//  echo "<pre>";
// 	print_r($arrayConfig);
// 	echo "</pre>";
// 	die;
 	
	return $arrayConfig;
}