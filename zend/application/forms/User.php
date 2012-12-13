<?php
class Application_Form_User extends Zend_Form
{
	public function init()
	{
		$this->setName('user');
		$id = new Zend_Form_Element_Hidden('iduser');
		$id->addFilter('Int');
		
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
		
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
		
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Description')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$photo = new Zend_Form_Element_File('photo');
		// A nivel de formulario, le decimos dónde queremos que se guarde la imagen
		$photo->setLabel('Photo')
		->addValidator('NotEmpty')
		->setDestination(APPLICATION_PATH . '/../public/uploads');
		
		$coders = new Zend_Form_Element_Radio('coders');
		$coders->setLabel('Coders')
		->setRequired(true)
		->setMultiOptions(array(1=>'php', 2=>'java'))
		->addValidator('NotEmpty');
		
		$city = new Zend_Form_Element_Select('cities_idcity');
		$city->setLabel('City')
		->setRequired(true)
		->setMultiOptions(array(1=>'NY', 2=>'ZGZ', 3=>'BCN'))
		->addValidator('NotEmpty');
		
		$languages = new Zend_Form_Element_MultiCheckbox('languages');
		$languages->setLabel('Languages')
		->setRequired(true)
		->setMultiOptions(array(1=>'English', 2=>'Spanish', 3=>'Dutch'))
		->addValidator('NotEmpty');
		
		$pets = new Zend_Form_Element_Multiselect('pets');
		$pets->setLabel('Pets')
		->setRequired(true)
		->setMultiOptions(array(1=>'Gato', 2=>'Tigre', 3=>'Lobo'))
		->addValidator('NotEmpty');
		
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $name, $email, $password, $description,
		        $photo,$coders,$city,
		        $languages,$pets,
		        $submit));
	}
}