<?php

declare(strict_types=1);

namespace Contexte;
 
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [


    'router' => [
    	'routes' => [
            'contexte' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/contexte/management',
    				'defaults' => [
    					'controller' => Controller\ContextecategorieController::class,
    					'action' => 'index'
    				],
    			],
                'child_routes' => [
                    'actions-contexte-tree' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/tree-contexte', 
                            'defaults' => [ 
                                'controller' => Controller\CommunController::class,
                                'action' => 'tree-contexte',
                            ],  
                        ],
                    ],
                    'actions-gestion-contexte' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/gestion-contexte', 
                            'defaults' => [ 
                                'controller' => Controller\AdminController::class,
                                'action' => 'index',
                            ],  
                        ],
                    ], 
                    'action-contexte-menu' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/menu[/:categorie]', 
                            'defaults' => [  
                                'controller' => Controller\AdminController::class,
                                'action' => 'gest-contexte',
                            ],  
                            'constraints' => [ 
                                'categorie' => '[a-zA-Z0-9.-_]*$',
                            ],
                        ],
                    ],  
                    'action-contexte-lister' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/liste-contexte[/:categorie]', 
                            'defaults' => [  
                                'controller' => Controller\AdminController::class, 
                                'action' => 'liste-contexte',
                            ],  
                            'constraints' => [ 
                                'categorie' => '[a-zA-Z0-9.-_]*',
                            ],
                        ],
                    ],  
                    'action-contexte-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add-Contexte[/:categorie][/:id]', 
                            'defaults' => [ 
                                'controller' => Controller\AdminController::class, 
                                'action' => 'add-contexte',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*',
                                'categorie' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                        ],
                    ], 
                    'action-contexte-add-withId' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add-Contexte[/:id]', 
                            'defaults' => [ 
                                'controller' => Controller\AdminController::class, 
                                'action' => 'add-contexte',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*', 
                            ],
                        ],
                    ], 
                    'actions-contexte-save' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/save-contexte[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\AdminController::class, 
                                'action' => 'save-contexte',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*$',
                            ],
                        ],
                    ], 
                    'actions-contexte-delete' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/delete-contexte[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\AdminController::class, 
                                'action' => 'remove-contexte',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]+$',
                            ],
                        ],
                    ], 
                    'actions-categorie-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextecategorieController::class,
                                'action' => 'add-categorie',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*$',
                            ],
                        ],
                    ],
                    'actions-categorie-save' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/save-categorie[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextecategorieController::class,
                                'action' => 'save-categorie',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*$',
                            ],
                        ],
                    ], 
                    'actions-categorie-lister' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/lister-categorie[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextecategorieController::class,
                                'action' => 'index',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*$',
                            ],
                        ],
                    ], 
                    'actions-categorie-delete' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/delete-categorie[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextecategorieController::class,
                                'action' => 'index',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*$',
                            ],
                        ],
                    ], 
                    'actions-contexte-structure-save' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/save-structure[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextestructureController::class,
                                'action' => 'save-structure',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*$',
                            ],
                        ],
                    ], 
                    'actions-contexte-structure-delete' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/delete-structure[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextestructureController::class,
                                'action' => 'remove-structure',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*$',
                            ],
                        ],
                    ], 
                    'actions-contexte-structure-lister' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/lister-structure[/:contexte]', 
                            'defaults' => [  
                                'controller' => Controller\ContextestructureController::class,
                                'action' => 'lister-structue',
                            ],  
                            'constraints' => [ 
                                'contexte' => '[0-9]*$',
                            ],
                        ],
                    ], 
                    'actions-contexte-structure-form' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/afficher-form[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextestructureController::class,
                                'action' => 'afficher-form',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*$',
                                
                            ],
                        ],
                    ], 
                    'actions-contexte-structure-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add-structure[/:contexte][/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextestructureController::class,
                                'action' => 'add-structure',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*', 
                                'contexte' => '[0-9]*',
                            ],
                        ],
                    ], 
                    'actions-contexte-menu-structure' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/gestion-structure[/:id]', 
                            'defaults' => [  
                                'controller' => Controller\ContextestructureController::class,
                                'action' => 'gestion-structure',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*', 
                            ],
                        ],
                    ], 
                ],
            ],
        ]
        ],
    'controllers' => [
    	'factories' => [
            Controller\AdminController::class => Controller\Factory\AdminControllerFactory::class,
            Controller\CommunController::class=> Controller\Factory\CommunControllerFactory::class,
            Controller\ContextecategorieController::class=> Controller\Factory\ContextecategorieControllerFactory::class,
            Controller\ContextestructureController::class=> Controller\Factory\ContextestructureControllerFactory::class

        ],
    ],
    'view_manager' => [
    	'template_map' => [ 
            'layout/layout'  => __DIR__ . '/../../../layouts/adminlte3/layout/layout.phtml',
               #admin
               'contexte/add'   => __DIR__ . '/../view/contexte/admin/add.phtml', 
               'contexte/lister-contexte'   => __DIR__ . '/../view/contexte/admin/lister.phtml', 
               'contexte/admin-managment'   => __DIR__ . '/../view/contexte/admin/gestion-contexte.phtml', 
               'contexte/admin-menu'   => __DIR__ . '/../view/contexte/admin/gest-contexte-menu.phtml', 

                #communJson 
                'Contexte-Communjson/json-view'   => __DIR__ . '/../view/contexte/communjson/jsonview.phtml', 

                #categorie
                'contexte/categorie-add' => __DIR__ . '/../view/contexte/categorie/add.phtml', 
                'contexte/lister-Categorie'=>  __DIR__ . '/../view/contexte/categorie/lister.phtml', 


                #structure
                'contexte/add-structure'   => __DIR__ . '/../view/contexte/structure/add.phtml', 
                'contexte/gestion-menu-structure'  => __DIR__ . '/../view/contexte/structure/gestion-structure-menu.phtml', 

    	],
    	'template_path_stack' => [
    		'sessionpreinscription' => __DIR__ . '/../view'
    	]
    ], 
];