<?php

class LanguageController extends Zend_Controller_Action
{

    public function init ()
    {
        /* Initialize action controller here */
    }

    public function indexAction ()
    {
        // Instancia del Model, que es el dbtable de la tabla language
        $languages = new Application_Model_DbTable_Languages();
        // Enviamos los objetos a mostrar en la vista
        $this->view->languages = $languages->fetchAll();
    }
    
    public function addAction()
    {
    	$form = new Application_Form_Language();
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$language = $form->getValue('language');
    			$languages = new Application_Model_DbTable_Languages();
    			$languages->addLanguage($language);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	}
    }
    
    public function editAction()
    {
    	$form = new Application_Form_Language();
    	$form->submit->setLabel('Save');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$id = (int)$form->getValue('idlanguage');
    			$language = $form->getValue('language');
    			$languages = new Application_Model_DbTable_Languages();
    			$languages->updateLanguage($id, $language);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	} else {
    		$id = $this->_getParam('idlanguage', 0);
    		if ($id > 0) {
    			$languages = new Application_Model_DbTable_Languages();
    			$form->populate($languages->getLanguage($id));
    		}
    	}
    }
    
    public function deleteAction()
    {
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == 'Yes') {
    			$id = $this->getRequest()->getPost('idlanguage');
    			$languages = new Application_Model_DbTable_Languages();
    			$languages->deleteLanguage($id);
    		}
    		$this->_helper->redirector('index');
    	} else {
    		$id = $this->_getParam('idlanguage', 0);
    		$languages = new Application_Model_DbTable_Languages();
    		$this->view->language = $languages->getLanguage($id);
    	}
    }
}

