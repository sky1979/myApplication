<?php
	namespace User\Form;
	use Zend\Form\Form,
	Zend\Form\Element;
	class UserForm extends Form
	{
		public function init()
		{
			$this->setName('user');
			$id = new Element\Hidden('id');
			$id->addFilter('Int');
			$firstname = new Element\Text('firstname');
			$firstname->setLabel('First Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
			$lastname = new Element\Text('lastname');
			$lastname->setLabel('Last Name')
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
			$unlocked = new Element\Checkbox('unlocked');
				$unlocked->setRequired(true)
				->setCheckedValue(true);			
			$unlocked->setDescription('Unlocked');			
			$right1 = new Element\Checkbox('right1');
				$right1->setRequired(true)
				->setCheckedValue(true);			
			$right1->setDescription('Right1');	
			$right2 = new Element\Checkbox('right2');
				$right2->setRequired(true)
				->setCheckedValue(true);			
			$right2->setDescription('Right 2');	
			
			$submit = new Element\Submit('submit');
			$submit->setAttrib('id', 'submitbutton');
			$this->addElements(array($id, $firstname, $lastname, $password, $unlocked, $right1, $right2, $submit));
		}
}