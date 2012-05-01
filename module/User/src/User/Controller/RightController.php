<?php
	namespace User\Controller;
	use Zend\Mvc\Controller\ActionController,
		Zend\View\Model\ViewModel,		
		User\Form\RightForm,
		Doctrine\ORM\EntityManager;
	class RightController extends ActionController
	{
		/**
		* @var \Doctrine\ORM\EntityManager
		*/
		protected $_em;
 
		public function setEntityManager(EntityManager $em)
		{
			$this->_em = $em;
		}
		
		public function indexAction()
		{		
			return array(
						'rights' => $this->_em->getRepository('User\Entity\Right')->findAll(),												
			);
		}

		public function addAction()
		{
			
			$request = $this->getRequest();
			if ($request->isPost()) {
				$formData = $request->post()->toArray();
				if ($form->isValid($formData)) {
					$right = new Right();
					$right->unlocked = $form->getValue('unlocked');
					$right->right1 = $form->getValue('right1');
					$right->right2 = $form->getValue('right2');

					$this->_em->persist($right);
					$this->_em->flush();

					// Redirect to list of rights
					return $this->redirect()->toRoute('default', array(
						'controller' => 'right',
						'action'     => 'index',
					));
				}
			}
			return array('form' => $form);
		}

		public function editAction()
		{
			$form = new RightForm();
			$form->submit->setLabel('Edit');

			$request = $this->getRequest();
			if ($request->isPost()) {
				$formData = $request->post()->toArray();
				if ($form->isValid($formData)) {

					$right = $this->_em->find('User\Entity\Right', $form->getValue('id'));
					if ($right) {
						$right->unlocked = $form->getValue('unlocked');
						$right->right1 = $form->getValue('right1');
						$right->right2 = $form->getValue('right2');
						$this->_em->flush();
					}

					// Redirect to list of rights
					return $this->redirect()->toRoute('default', array(
						'controller' => 'right',
						'action'     => 'index',
					));
				}
			} else {
				$right = $this->_em->find('User\Entity\Right', $request->query()->get('id', 0));
				if ($right) {
				  $form->populate($right->toArray());
				}
			}

			return array('form' => $form);
		}

		public function deleteAction()
		{
			$request = $this->getRequest();
			if ($request->isPost()) {
				$del = $request->post()->get('del', 'No');
				if ($del == 'Yes') {
					$right = $this->_em->find('User\Entity\Right', $request->post()->get('id'));
					if ($right) {
						$this->_em->remove($right);
						$this->_em->flush();
					}
				}

				// Redirect to list of rights
				return $this->redirect()->toRoute('default', array(
					'controller' => 'right',
					'action'     => 'index',
				));
			}

			$id = $request->query()->get('id', 0);
			return array('right' => $this->_em->find('User\Entity\Right', $id)->toArray());
		}		
	}