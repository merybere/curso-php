<?php

defined('APPLICATION_ENV')?:
	define('APPLICATION_ENV', getenv('APPLICATION_ENV'));

defined('APPLICATION_PATH')?:
	define('APPLICATION_PATH', '../application');

defined('DOCUMENT_ROOT')?:
	define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

//require_once '/../ZendGdata-1.12.0/library/Zend/Loader.php';
require_once '/../ZendGdata-1.12.0/library/Zend/Gdata/Spreadsheets.php';
require_once '/../ZendGdata-1.12.0/library/Zend/Gdata/ClientLogin.php';
//require_once '/../ZendGdata-1.12.0/library/Zend/Gdata/Spreadsheets/DocumentQuery.php';

require_once(APPLICATION_PATH."/models/applicationModel.php");
//require_once(APPLICATION_PATH."/models/usersModel.php");
require_once(APPLICATION_PATH."/models/usersDriveModel.php");

require_once(APPLICATION_PATH."/models/debugModel.php");

require (APPLICATION_PATH."/bootstrap.php");


