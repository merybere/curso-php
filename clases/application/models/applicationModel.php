<?php 


class Models_applicationModel
{
	

	/**
	 * Read config file to array
	 * @param string $configFile Config filename
	 * @param string $context Context
	 * @return array: Config context array
	 */
	public static function readConfig($configFile, $context)
	{	
		// 	Leer el .ini
		$arrayConfigs = parse_ini_file($configFile, true);
		
		// 	Obtener las llaves
		$arrayKeys = array_keys($arrayConfigs);

		// 	Para cada llave
		foreach($arrayKeys as $keys)
		{
			// Obtener key
			// Obtener subkey
			$arrayKey = explode(':', $keys);
			if($context == $arrayKey[0])
			{
				$key = $arrayKey[0];
				if(isset($arrayKey[1]))
					$subkey = $arrayKey[1];
			}		
				
		}
		if(isset($subkey))
			$arrayConfig = array_merge($arrayConfigs[$subkey],
									$arrayConfigs[$key.":".$subkey]								 
						 );
		else
			$arrayConfig = $arrayConfigs[$key];
		
		return $arrayConfig;
	}
	
	
	public function renderView($config, $view, array $params)
	{
		
		ob_start();
		include($config['viewsDirectory'] . "/" . $view . ".php");
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	public function renderLayout($config, $layout, array $params)
	{
	
		ob_start();
		include($config['layoutDirectory'] . "/" . $layout . ".php");
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	
	public static function setRequest()
	{
		$uri = (explode('/', $_SERVER['REQUEST_URI']));
		
		if($uri[1] != '')
		if(file_exists(APPLICATION_PATH . "/controllers/" . $uri[1] . ".php"))
		{
			if(isset($uri[1]))
				$_GET['controller'] = $uri[1];
			else
				$_GET['controller'] = 'index';
			if(isset($uri[2]))
				$_GET['action'] = $uri[2];
			else
				$_GET['action'] = 'index';
		}
		else
		{
			$_GET['controller'] = 'error';
			$_GET['action'] = '404';
		}
		else
		{
			$_GET['controller'] = 'index';
			$_GET['action'] = 'index';
		}
			
		$arrayRequest = array('controller'=>$_GET['controller'],
							'action'=>$_GET['action']);
		
		return $arrayRequest;
	}
	
	
	
	public static function acl($arrayRequest, $config)
	{	
		// El bootstrap a través de _initDb() ya ha instanciado un objeto mysqlModel
		// Hacemos uso de él a través de la sesión
		$objDb = $_SESSION['register']['db'];
		$sql = "SELECT resource 
				FROM resources
				LEFT JOIN roles_has_resources 
				ON resources.idresource=roles_has_resources.resources_idresource
				WHERE roles_has_resources.roles_idrol = " . 
			$_SESSION[$config['sessionNamespace']]['user_rol'];
		$resources = $objDb->query($sql);
		foreach ($resources as $resource)
		{
			$arrayResources[] = $resource['resource'];
		}
	 
		if(in_array("/" . $arrayRequest['controller'] . "/" . $arrayRequest['action'], 
					$arrayResources))
			$arrayRequest = $arrayRequest;
		elseif(in_array("/".$arrayRequest['controller'], $arrayResources))
			$arrayRequest = $arrayRequest;
		else
		{
			$arrayRequest['controller']='error';
			$arrayRequest['action']='403';
		}
			
		return $arrayRequest;
	}
}