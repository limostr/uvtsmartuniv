<?php

declare(strict_types=1);

namespace Formation;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
    	'routes' => [
            'niveau' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/niveau/admin',
                    'defaults' => [
                        'controller' => Controller\NiveauController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'actions-niveau-parametrage' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/parametrage[/:id]',   
                            'defaults' => [ 
                                'controller' => Controller\NiveauController::class,
                                'action' => 'parametrage',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                             
                        ],
                    ],    
                ]
            ],
            'formation' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/formation/admin',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [ 
                    'actions-formation-tree' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/tree-formation', 
                            'defaults' => [ 
                                'controller' => Controller\CommunController::class,
                                'action' => 'tree-formation',
                            ],  
                        ],
                    ],
                    'actions-formation-parametrage' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/parametrage[/:id]',   
                            'defaults' => [ 
                                'controller' => Controller\AdminController::class,
                                'action' => 'parametrage',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                             
                        ],
                    ],
                    'actions-gestion-formation' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/gestion-formation', 
                            'defaults' => [ 
                                'controller' => Controller\AdminController::class,
                                'action' => 'management',
                            ],  
                        ],
                    ], 
                ],
            ], 
    	],
    ],
    'controllers' => [
    	'factories' => [
            Controller\AdminController::class => Controller\Factory\AdminControllerFactory::class,
            Controller\CommunController::class=> Controller\Factory\CommunControllerFactory::class,
            Controller\NiveauController::class => Controller\Factory\NiveauControllerFactory::class,
 
        ],
    ],
    'view_manager' => [
    	'template_map' => [ 
            'layout/layout'  => __DIR__ . '/../../../layouts/adminlte3/layout/layout.phtml',
            #formation
            'formation/formation-parametrage'   => __DIR__ . '/../view/formation/parametrage.phtml', 
            'communjson/json-view'   => __DIR__ . '/../view/communjson/jsonview.phtml',
            'formation/admin-managment'   => __DIR__ . '/../view/formation/gestion-formation.phtml', 


            #niveau
            'Niveau/Niveau-parametrage'  => __DIR__ . '/../view/niveau/parametrage.phtml', 


    	],
    	'template_path_stack' => [
    		'user' => __DIR__ . '/../view'
    	]
    ],
     
];
