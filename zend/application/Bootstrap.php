<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Inicializa la vista del bootstrap, y define que toda la aplicación, a nivel
     * de bootstrap es html4
     */
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
}

