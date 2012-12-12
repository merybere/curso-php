<?php

class UserController extends Zend_Controller_Action
{

    public function init ()
    {
        /* Initialize action controller here */
    }

    public function indexAction ()
    {
        // Instancia del Model, que es el dbtable de la tabla album
        $albums = new Application_Model_DbTable_Users();
        // Enviamos los objetos a mostrar en la vista
        $this->view->users = $users->fetchAll();
    }
    
    public function addAction()
    {
    	$form = new Application_Form_User();
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    		    $userData = array(
    		            'name'        => $form->getValue('name'),
    					'email'       => $form->getValue('email'),
    					'password'    => $form->getValue('password'),
    					'description' => $form->getValue('description'),
    					'photo'       => $form->getValue('photo'),
    					'coders'      => $form->getValue('coders'),
    					'city'        => $form->getValue('city'),
    					'pets'        => $form->getValue('pets'),
    					'languages'   => $form->getValue('languages'));
    			$users = new Application_Model_DbTable_Users();
    			$users->addUser($userData);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	}
    }
    
    public function editAction()
    {
    	$form = new Application_Form_Album();
    	$form->submit->setLabel('Save');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$id = (int)$form->getValue('id');
    			$artist = $form->getValue('artist');
    			$title = $form->getValue('title');
    			$albums = new Application_Model_DbTable_Albums();
    			$albums->updateAlbum($id, $artist, $title);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	} else {
    		$id = $this->_getParam('id', 0);
    		if ($id > 0) {
    			$albums = new Application_Model_DbTable_Albums();
    			$form->populate($albums->getAlbum($id));
    		}
    	}
    }
    
    public function deleteAction()
    {
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == 'Yes') {
    			$id = $this->getRequest()->getPost('id');
    			$albums = new Application_Model_DbTable_Albums();
    			$albums->deleteAlbum($id);
    		}
    		$this->_helper->redirector('index');
    	} else {
    		$id = $this->_getParam('id', 0);
    		$albums = new Application_Model_DbTable_Albums();
    		$this->view->album = $albums->getAlbum($id);
    	}
    }
}

