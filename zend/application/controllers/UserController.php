<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        // action body
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll();
    }

    public function addAction()
    {
        $model = new Application_Model_User();
        
        $form = new Application_Form_User();
        
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        $form->photo->setValueDisabled(true);
        
        if ($this->getRequest()->isPost()) {
            
            $newname = $model->renameImage($form->getValue('photo'));
            $form->photo->setValue($newname);
            
            $formData = $this->getRequest()->getPost();

        	if ($form->isValid($formData)) {
        		$name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		$description = $form->getValue('description');
        		$coders = $form->getValue('coders');
        		$cities_idcity = $form->getValue('cities_idcity');
        		
        		// Añadir un filtro, para cambiar el nombre de la imagen
        		// por el que devuelve renameImage
        		$form->photo->addfilter('Rename', $newname);
        		if (!$form->photo->receive())
        		{
        			print "Upload error";
        		}
        		$photo = $newname;
        		
        		$users = new Application_Model_DbTable_Users();
        		$users->addUser($name, $email, $password, $description,
        		        	$photo, $coders, $cities_idcity);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }
    
    public function editAction()
    {
        // Instancia del modelo de usuarios, para renombrar la foto si ya existe
        $model = new Application_Model_User();
        
        $form = new Application_Form_User();
        $form->submit->setLabel('Save');
        
        $this->view->form = $form;

        $form->photo->setValueDisabled(true);
        
        if ($this->getRequest()->isPost()) {
            
        	$newname = $model->renameImage($form->getValue('photo'));
            $form->photo->setValue($newname);
            
            $formData = $this->getRequest()->getPost();
            
        	if ($form->isValid($formData)) {
        		$id = (int)$form->getValue('iduser');
        		$name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		$description = $form->getValue('description');
        		// Añadir un filtro, para cambiar el nombre de la imagen
        		// por el que devuelve renameImage
        		$form->photo->addfilter('Rename', $newname);
        		if (!$form->photo->receive())
        		{
        			print "Upload error";
        		}
        		$photo = $newname;
        		$coders = $form->getValue('coders');
        		$cities_idcity = $form->getValue('cities_idcity');
        		
        		$users = new Application_Model_DbTable_Users();
        		$users->updateUser($id, $name, $email, $password, $description,
        		        	$photo, $coders, $cities_idcity);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        } else {
        	$id = $this->_getParam('iduser', 0);
        	if ($id > 0) {
        		$users = new Application_Model_DbTable_Users();
        		$form->populate($users->getUser($id));
        	}
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') 
        	{
        		$id = $this->getRequest()->getPost('iduser');
        		$users = new Application_Model_DbTable_Users();
        		$users->deleteUser($id);
        	}
        	$this->_helper->redirector('index');
        } else {
        	$id = $this->_getParam('iduser', 0);
        	$users = new Application_Model_DbTable_Users();
        	$this->view->user = $users->getUser($id);
        }
    }
    
    public function loginAction()
    {
        $this->_helper->layout->setLayout('layout_login');
        
        // Modelo de usuarios
        $model = new Application_Model_User();
        // Formulario de usuario y contraseña
        $form = new Application_Form_Login();
        
        $form->submit->setLabel('Login');
        
        $this->view->form = $form;
                
        if ($this->getRequest()->isPost()) 
        {
                
        	$formData = $this->getRequest()->getPost();
        
        	if ($form->isValid($formData)) 
        	{
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		
        		// Conexión del adatpador a la base de datos
        		
        		$users = new Application_Model_DbTable_Users();
        		
        		// Coger el adaptador de la base de datos desde una tabla que va a la bd
        		$dbAdapter = $users->getAdapter();
        		
        		$authAdapter = new Zend_Auth_Adapter_DbTable(
        		        $dbAdapter,
        		        'users',
        		        'email',
        		        'password'
        		        );
        		
        		$authAdapter->setIdentity($email)
        					->setCredential($password);
        		
        		// Instancia del objeto Zend_Auth, como un singleton
        		$auth = Zend_Auth::getInstance();
        		
        		// Autenticar el adapter. Esto devolverá si queda o no validado
        		$auth->authenticate($authAdapter);
        		// Salta al controlador backend, acción index
        		$this->_helper->redirector('index', 'backend');
        	} 
        	else 
        	{
        		$form->populate($formData);
        	}
        }
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        // Destruir la sesión
        Zend_Session::destroy();
        $this->_helper->redirector('index');
        //$this->redirect($_SERVER['HTTP_REFERER']);
    }
}

