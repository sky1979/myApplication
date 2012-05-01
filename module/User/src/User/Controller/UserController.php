<?php
	namespace User\Controller;
	use Zend\Mvc\Controller\ActionController,
		User\Form\UserForm,
		User\Form\LoginForm,
		User\Entity\User,
		User\Entity\Right,
		Zend\Loader,
		Doctrine\ORM\EntityManager;

	class UserController extends ActionController
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
						'users' => $this->_em->getRepository('User\Entity\User')->findAll(),												
			);
		}		
		public function loginAction()
		{	
			$form = new LoginForm();
			$request = $this->getRequest();
			if ($request->isPost()) {												
				$formData = $request->post()->toArray();
				if ($form->isValid($formData)) {
					$username = $form->getValue('firstname');
					$user = $this->_em->getRepository('User\Entity\User')->findOneBy(array('firstname' => $username)); 
					if ($user){
						$userpassword = mhash(MHASH_MD5, $form->getValue('password')); //ENCRYPT PASSWORD
						if ($userpassword == $user->password){
							// Redirect to list of users
							return $this->redirect()->toRoute('default', array(
								'controller' => 'user',
								'action'     => 'index',
							));							
						}
						else{ 
							print "Password incorrect!";
						}
					}else{
							print "User not found!";
					}									
				}
			}
			return array('form' => $form);	
		}	
		public function addAction()
		{
			$form = new UserForm();
			$form->submit->setLabel('Add');

			$request = $this->getRequest();
			if ($request->isPost()) {
				$formData = $request->post()->toArray();
				if ($form->isValid($formData)) {					
					$user = new User();
					$right = new Right();
					
					$user->firstname = $form->getValue('firstname');
					$user->lastname = $form->getValue('lastname');
					$user->password = mhash(MHASH_MD5, $form->getValue('password')); //ENCRYPT PASSWORD
										
					
					$right->unlocked = $form->getValue('unlocked');
					$right->right1 = $form->getValue('right1');
					$right->right2 = $form->getValue('right2');
					$right->user = $user; 
					$this->_em->persist($right);
					$this->_em->flush();
					// Redirect to list of users
					return $this->redirect()->toRoute('default', array(
						'controller' => 'user',
						'action' => 'index',
					));
				}
			}
			return array('form' => $form);		
		}
		public function editAction()
		{
			$form = new UserForm();
			$form->submit->setLabel('Edit');

			$request = $this->getRequest();
			if ($request->isPost()) {
				$formData = $request->post()->toArray();
				if ($form->isValid($formData)) {					
					$user = $this->_em->find('User\Entity\User', $form->getValue('id'));					
					if ($user) {
						$user->firstname =$form->getValue('firstname');
						$user->lastname = $form->getValue('lastname');
						$user->password = mhash(MHASH_MD5, $form->getValue('password')); //ENCRYPT PASSWORD
						//$user->password = $form->getValue('password');		
						$right = $this->_em->getRepository('User\Entity\Right')->findOneBy(array('user_id' => $form->getValue('id'))); 							
						$right->unlocked = $form->getValue('unlocked');
						$right->right1 = $form->getValue('right1');
						$right->right2 = $form->getValue('right2');
						$this->_em->flush();
					}

					// Redirect to list of users
					return $this->redirect()->toRoute('default', array(
						'controller' => 'user',
						'action'     => 'index',
					));
				}
			} else {
				$user = $this->_em->getRepository('User\Entity\User')->find($request->query()->get('id', 0));
				$right = $this->_em->getRepository('User\Entity\Right')->findOneBy(array('user_id' => $user->id)); 
				if ($right){
						$form->populate($right->toArray());
					}
				if ($user) {
				  $form->populate($user->toArray());					
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
					$user = $this->_em->find('User\Entity\User', $request->post()->get('id'));					
					if ($user) {		
						$right = $this->_em->getRepository('User\Entity\Right')->findOneBy(array('user_id' => $user->id)); 
						$this->_em->remove($right);
						$this->_em->remove($user);
						$this->_em->flush();						
						
					}
				}

				// Redirect to list of users
				return $this->redirect()->toRoute('default', array(
					'controller' => 'user',
					'action'     => 'index',
				));
			}

			$id = $request->query()->get('id', 0);
			
			return array('user' => $this->_em->find('User\Entity\User', $id)->toArray());			
		}		
	}