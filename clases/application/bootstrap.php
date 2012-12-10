<?php

class Application_bootstrap
{
	protected $configFile;
	protected $config;
	protected $request;
	
	public function __construct($filename)
	{
		$this->configFile = $filename;
		$this->_initSession();
		$this->_initConfig($filename);
		$this->_initDb();
		$this->_initRequest();
		$this->_initDefaultRol();
		$this->_initAcl();
		Models_debugModel::_debug($_SESSION);
	}
	
	/**
	 * Inicio de sesión
	 */
	protected function _initSession()
	{
		session_start();
		
		// Crear un array vacio en el namespace
		if (!isset($_SESSION[$this->config['sessionNamespace']]))
			$_SESSION[$this->config['sessionNamespace']] = array();
	}
	
	/**
	 * Lectura del archivo de configuración config.ini
	 */
	protected function _initConfig()
	{
		$this->config = Models_applicationModel::readConfig(
					'../application/configs/' . $this->configFile, 
					APPLICATION_ENV);
	}
	
	/**
	 * Introducir la conexión a la base de datos en el registro de la sesión
	 */
	protected function _initDb()
	{
		// Siempre que pase por el bootstrap verificará la conexión a la BD
 		$_SESSION['register']['db'] = Models_mysqlModel::singleton($this->config);
	}
	
	protected function _initRequest()
	{
		$this->request = Models_applicationModel::setRequest();
	}
	
	protected function _initDefaultRol()
	{
		$_SESSION[$this->config['sessionNamespace']]['user_rol'] = $this->config['defaultRol'];
	}
	
	public function _initAcl()
	{
		$this->request = Models_applicationModel::acl($this->request, $this->config);
	}
	
	public function run()
	{
		include("../application/controllers/" . $this->request['controller'] . ".php");
	}
}
