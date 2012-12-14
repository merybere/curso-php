<?php

$config = readConfig('../application/configs/config.ini', APPLICATION_ENV);

// Crear el espacio de variables global 
session_start();

$root = dirname(__FILE__);
require_once 'Zend/Loader.php';
set_include_path($root.'/lib'.PATH_SEPARATOR.get_include_path());

Zend_Loader::loadClass('Zend_Http_Client');
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

$httpClient = Zend_Gdata_ClientLogin::getHttpClient(
		$config['user'], $config['psw'], Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME);

$gdClient = new Zend_Gdata_Spreadsheets($httpClient);

include("../application/controllers/users.php");	

