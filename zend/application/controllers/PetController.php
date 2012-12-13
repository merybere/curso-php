<?php

class PetController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $pets = new Application_Model_DbTable_Pets();
        $this->view->pets = $pets->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Pet();
        
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    $pet = $form->getValue('pet');
        	    
        		$pets = new Application_Model_DbTable_Pets();
        		$pets->addPet($pet);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }
    
    public function editAction()
    {
        $form = new Application_Form_Pet();
        $form->submit->setLabel('Save');
        
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$id = (int)$form->getValue('idpet');
        		$pet = $form->getValue('pet');
        		
        		$pets = new Application_Model_DbTable_Pets();
        		$pets->updatePet($id, $pet);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        } else {
        	$id = $this->_getParam('idpet', 0);
        	if ($id > 0) {
        		$pets = new Application_Model_DbTable_Pets();
        		$form->populate($pets->getPet($id));
        	}
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') {
        		$id = $this->getRequest()->getPost('idpet');
        		$pets = new Application_Model_DbTable_Pets();
        		$pets->deletePet($id);
        	}
        	$this->_helper->redirector('index');
        } else {
        	$id = $this->_getParam('idpet', 0);
        	$pets = new Application_Model_DbTable_Pets();
        	$this->view->pet = $pets->getPet($id);
        }
    }
}

