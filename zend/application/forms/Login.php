<?php
class Application_Form_Login extends Zend_Form
{
	public function init()
	{
		$this->setName('user');
		$id = new Zend_Form_Element_Hidden('iduser');
		$id->addFilter('Int');

		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addValidator('EmailAddress');
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
				
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $email, $password, $submit));
	}
}