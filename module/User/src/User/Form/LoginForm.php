<?php
	namespace User\Form;
	use Zend\Form\Form,
	Zend\Form\Element;
	class LoginForm extends Form
	{
		public function init()
		{
		$firstname = new Element\Text('firstname');
			$firstname->setLabel('First Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');			
			$password = new Element\Text('password');
			$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');					
			
			$submit = new Element\Submit('submit');
			$submit->setAttrib('id', 'submitbutton');
			$this->addElements(array($firstname, $password, $submit));		
		}
}