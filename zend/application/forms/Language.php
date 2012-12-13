<?php
class Application_Form_Language extends Zend_Form
{
	public function init()
	{
		$this->setName('language');
		$id = new Zend_Form_Element_Hidden('idlanguage');
		$id->addFilter('Int');
		
		$language = new Zend_Form_Element_Text('language');
		$language->setLabel('Language')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
				
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $language,  $submit));
	}
}