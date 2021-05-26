<?php

declare(strict_types=1);

namespace Candidats;
 
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [


    'router' => [
    	'routes' => [
            'dashboard' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/tableau-de-bord',
    				'defaults' => [
    					'controller' => Controller\DashboardController::class,
    					'action' => 'index'
    				],
    			],
    		],
			'etapes-preinscription' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/je-m-inscrit',
    				'defaults' => [
    					'controller' => Controller\EtapesController::class,
    					'action' => 'etapes-menu'
    				],
    			],
				'child_routes' => [
					'actions-Les-etapes' => [
						'type' =>  Segment::class,
                        'options' => [
                            'route' => '/etapes[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\EtapesController::class,
                                'action' => 'etapes-menu',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9.-_]*$',
                            ],
                        ],
                    ],
                    'actions-etapes-fixe' => [
						'type' =>  Segment::class,
                        'options' => [
                            'route' => '/diplomes[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\EtapesfixeController::class,
                                'action' => 'diplomes',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9.-_]*$',
                            ],
                        ],
                    ],
                    'actions-etapes-diplome' => [
						'type' =>  Segment::class,
                        'options' => [
                            'route' => '/mes-diplomes[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\EtapesfixeController::class,
                                'action' => 'gest-diplome',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9.-_]*$',
                            ],
                        ],
                    ],
                    'actions-etapes-diplome-liste' => [
						'type' =>  Segment::class,
                        'options' => [
                            'route' => '/liste-diplomes[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\EtapesfixeController::class,
                                'action' => 'liste-diplome',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9.-_]*$',
                            ],
                        ],
                    ],
					'actions-annee-line' => [
						'type' =>  Segment::class,
                        'options' => [
                            'route' => '/annee-etude-line[/:nbr]', 
                            'defaults' => [  
                                'controller' => Controller\EtapesfixeController::class,
                                'action' => 'add-line-years',
                            ],  
                            'constraints' => [ 
                                'nbr' => '[0-9]*$',
                            ],
                        ],
                    ],
				],
    		],
        ],
    ],
    'controllers' => [
    	'factories' => [
            Controller\AdminController::class => InvokableFactory::class,
            Controller\DashboardController::class => InvokableFactory::class,
			Controller\EtapesController::class=> Controller\Factory\EtapesControllerFactory::class, 
			Controller\EtapesfixeController::class=> Controller\Factory\EtapesfixeControllerFactory::class, 
        ],
    ],
    'view_manager' => [
    	'template_map' => [ 
            //'layout/layout'  => __DIR__ . '/../../../layouts/adminlte3/layout/layout.phtml',
			'layout/layout'  => __DIR__ . '/../Layout/dashboard/tableaudebord.phtml',
			#tableau de board
			'Candidat/index-layout'   => __DIR__ . '/../Layout/dashboard/tableaudebord.phtml',  
            'Candidat/dashboard'   => __DIR__ . '/../view/candidat/dashboard/dashboard.phtml', 
			
			'etapes/etape-menu'   => __DIR__ . '/../view/candidat/etapes/etape-menu.phtml', 


			#etape fixd
			'etapes-fixe/cycle-etude'=> __DIR__ . '/../view/candidat/etape-predefini/cycle-etude.phtml', 
			'etapes-fixe/annee-etude'=> __DIR__ . '/../view/candidat/etape-predefini/annee-etude.phtml', 
			'etapes-fixe/diplome-etude'=> __DIR__ . '/../view/candidat/etape-predefini/diplome-info.phtml', 
			'etapes-fixe/line-annee'=> __DIR__ . '/../view/candidat/etape-predefini/line-annee-univ.phtml', 
            'etapes-fixe/gest-diplome'=> __DIR__ . '/../view/candidat/etape-predefini/diplome.phtml', 
            'etapes-fixe/liste-diplome'=> __DIR__ . '/../view/candidat/etape-predefini/liste-diplome.phtml', 

            
    	],
    	'template_path_stack' => [
    		'sessionpreinscription' => __DIR__ . '/../view'
    	]
    ], 
];