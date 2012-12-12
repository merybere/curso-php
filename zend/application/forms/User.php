<?php

class Application_Form_User extends Zend_Form
{

    public function init ()
    {
        $this->setName('user');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        'description' => $form->getValue('description'),
        'photo'       => $form->getValue('photo'),
        'coders'      => $form->getValue('coders'),
        'city'        => $form->getValue('city'),
        'pets'        => $form->getValue('pets'),
        'languages'   => $form->getValue('languages');
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
	        ->addFilter('Alpha', array('allowwhitespace' => true))
	        ->addValidator('NotEmpty');
        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('Password')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addFilter('Alnum')
            ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array(
                $id,
                $artist,
                $title,
                $submit
        ));
    }
}