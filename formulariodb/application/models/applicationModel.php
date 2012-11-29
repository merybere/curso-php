<?php

/**
 * 
 * @param string $configFile
 * @param string $context
 * @return multitype:
 */
function readConfig($configFile, $context)
{
	$arrayConfigs = array();
	
	// El segundo parámetro es process_sections, para devolver la configuración
	// varios contextos. Leer el .ini
	$arrayConfigs = parse_ini_file($configFile, true);
	
	// Obtener todas las keys del array de configuración
	$arrayKeys = array_keys($arrayConfigs);
	
	// Separar las keys por el caracter ':', para obtener la subkey.
	// En este caso sólo hay una subkey, pero puede haber varias, esto se 
	// debería hacer como una función recursiva
	foreach($arrayKeys as $keys) 
	{
		$arrayKey = explode(':', $keys);
		if ($context == $arrayKey[0]) 
		{
			// Obtener key
			$key = $arrayKey[0];
			// Obtener subkey
			if (isset($arrayKey[1]))
				$subkey = $arrayKey[1];
		}
	}

	if (isset($subkey))
		$arrayConfig = array_merge($arrayConfigs[$subkey], 
							$arrayConfigs[$key . ":" . $subkey]);
	else
		$arrayConfig = $arrayConfigs[$key];
 	
//  echo "<pre>";
// 	print_r($arrayConfig);
// 	echo "</pre>";
// 	die;
 	
	return $arrayConfig;
}

/**
 * Obtain a view in html
 * @param string $view: name of the view to render
 * @param array $config
 * @param array $params
 * @return string: html view
 */
function renderView($view, $config, array $params) 
{
	// Creación de un buffer de salida, que captura todo lo que va a ir a pantalla
	ob_start();
	
	include($config['viewsDirectory'] . "/" . $view . ".php");
	
	// El contenido del buffer, lo asignamos a la variable $content, para devolverla
	$content = ob_get_contents();
	// Cerrar el buffer
	ob_end_clean();
	
	return $content;
}