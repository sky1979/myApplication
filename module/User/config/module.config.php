<?php
	namespace User;
	return array(
		'di' => array(
		'instance' => array(
			'alias' => array(
						'user' => 'User\Controller\UserController',
						'right'=> 'User\Controller\RightController',
					),
			'User\Controller\UserController' => array(
				'parameters' => array(
					//'userTable' => 'User\Model\UserTable',
					'em' => 'doctrine_em',
				),
			),
			'User\Controller\RightController' => array(
				'parameters' => array(
					'em' => 'doctrine_em',
				),
			),
			'User\Model\UserTable' => array(
				'parameters' => array(
					'adapter' => 'Zend\Db\Adapter\Adapter',
				)
			),
			/*'Zend\Db\Adapter\Adapter' => array(
				'parameters' => array(
					'driver' => array(
						'driver' => 'Pdo',
						'dsn' => 'mysql:dbname=uplink_test;hostname=localhost',
						'username' => 'uplink_test',
						'password' => 'uplink_test',
					'driver_options' => array(
							PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
						),
					),
				)
			),*/									
			'Zend\View\Resolver\TemplatePathStack' => array(
					'parameters' => array(
						'paths' => array(
							'user' => __DIR__ . '/../view',
						),
					),
				),
			'orm_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(
                        'User' => array(
                            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                            'namespace' => __NAMESPACE__ . '\Entity',
                            'paths' => array(
                                __DIR__ . '/../src/'.__NAMESPACE__.'/Entity'
								),
							),
						'Right' => array(
                            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                            'namespace' => __NAMESPACE__ . '\Entity',
                            'paths' => array(
                                __DIR__ . '/../src/'.__NAMESPACE__.'/Entity'
								),
							),	
						),
					),
				),			
			),
		),
	);