<?php
	namespace User\Form;
	use Zend\Form\Form,
	Zend\Form\Element;
	class RightForm extends Form
	{
		public function init()
		{
			$this->setName('right');
			$id = new Element\Hidden('id');
			$id->addFilter('Int');
			$unlocked = new Element\Checkbox('unlocked')
				->setRequired(true)
				->setCheckedValue(true);			
			$unlocked->setDescription('Unlocked');			
			$submit = new Element\Submit('submit');
			$submit->setAttrib('id', 'submitbutton');
			$this->addElements(array($id, $unlocked));
		}
}