<?php

class AlbumController extends Zend_Controller_Action
{

    public function init()
    {
        // Proteger la página de album, para estar logeado
        $auth = Zend_Auth::getInstance();
        if($auth->getIdentity() == NULL)
            $this->_helper->redirector('login', 'user');
        Zend_Debug::dump($auth->getIdentity(), "identidad:");
    }

    public function indexAction()
    {
        // action body
        $albums = new Application_Model_DbTable_Albums();
        $this->view->albums = $albums->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Album();
        
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$artist = $form->getValue('artist');
        		$title = $form->getValue('title');
        		$albums = new Application_Model_DbTable_Albums();
        		$albums->addAlbum($artist, $title);
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
    
    /**
     * Método que muestra únicamente el array de albumes
     */
    public function testAction()
    {
        // Quitar la vista
        $this->_helper->viewRenderer->setNoRender(true);
        // Quitar el layout
        $this->_helper->layout->disableLayout();
        
        $model = new Application_Model_Album();
        Zend_Debug::dump($model->getAlbums());
    }
}

