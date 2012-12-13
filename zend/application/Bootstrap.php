<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    
    protected function _initConfig()
    {
        $config = new Zend_Config_Ini(
                	APPLICATION_PATH . '/configs/application.ini',
                	APPLICATION_ENV);
        // Para poder trabajar con el directorio donde se subirán las imágenes,
        // que está descrito en el $config, fuera del bootstrap:
        Zend_Registry::set('uploadDirectory', $config->uploadDirectory);
    }
}

