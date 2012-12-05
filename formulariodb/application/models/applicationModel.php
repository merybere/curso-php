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

function renderLayout($layout, $config, array $params)
{
	// Creación de un buffer de salida, que captura todo lo que va a ir a pantalla
	ob_start();

	include($config['layoutDirectory'] . "/" . $layout . ".php");

	// El contenido del buffer, lo asignamos a la variable $content, para devolverla
	$content = ob_get_contents();
	// Cerrar el buffer
	ob_end_clean();

	return $content;
}

function setRequest()
{
	// Separar la uri por la barra
	$uri = (explode('/', $_SERVER['REQUEST_URI']));
	
	if (file_exists(APPLICATION_PATH . "/controllers/" . $uri[1] . ".php"))
	{
		// Parsear la url
		// Controller
		if (isset($uri[1]))
			$_GET['controller'] = $uri[1];
		else
			$_GET['controller'] = 'index';
		
		// Accion
		if (isset($uri[2]))
			$_GET['action'] = $uri[2];
		else
			$_GET['action'] = 'index';
	}
	else
	{
		$_GET['controller'] = 'error';
		$_GET['action'] = '404';
	}
	$arrayRequest = array('controller'=>$_GET['controller'], 'action'=>$_GET['action']);
	return $arrayRequest;
}

function acl($arrayRequest, $rol, $cnx)
{	
	// Obtener los resources que tiene el usuario según su rol
	$sql = "SELECT resource
			FROM resources
			LEFT JOIN roles_has_resources rhr
			ON resources.idresource = rhr.resources_idresource
			WHERE rhr.roles_idrol = " . $rol;
	
	$resources = query($sql, $cnx);
	// Montar el array de recursos
	foreach ($resources as $resource)
	{
		$arrayResources[] = $resource['resource'];
	}
	
	if (in_array("/" . $arrayRequest['controller'] . "/" . $arrayRequest['action'], $arrayResources))
		$arrayRequest = $arrayRequest;
	elseif (in_array("/" . $arrayRequest['controller'], $arrayResources))
		$arrayRequest = $arrayRequest;
	else 
	{
		// Mostrar pantalla de error si no tiene permisos
		$arrayRequest['controller'] = 'error'; 
		$arrayRequest['action'] = '403';
	}
	
	return $arrayRequest;
}