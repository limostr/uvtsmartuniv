<?php

declare(strict_types=1);

namespace Sessionpreinscription;

 
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
    	'routes' => [
            'session' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/session/management',
    				'defaults' => [
    					'controller' => Controller\AdminController::class,
    					'action' => 'index'
    				],
    			],
                'child_routes' => [
                    'actions-session-tree' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/tree-session', 
                            'defaults' => [ 
                                'controller' => Controller\CommunController::class,
                                'action' => 'tree-session',
                            ],  
                        ],
                    ],
                    'actions-session-parametrage' => [
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
                    'actions-gestion-session' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/gestion-session', 
                            'defaults' => [ 
                                'controller' => Controller\AdminController::class,
                                'action' => 'index',
                            ],  
                        ],
                    ], 
                    'actions-display-linksession' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/link-session[/:niveau]', 
                            'defaults' => [ 
                                'controller' => Controller\DisplayController::class,
                                'action' => 'link-session',
                            ],  
                            'constraints' => [ 
                                'niveau' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ], 
                    'action-session-activer' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/link-activer[/:id]', 
                            'defaults' => [ 
                                'controller' => Controller\DisplayController::class,
                                'action' => 'link-session',
                            ],  
                            'constraints' => [ 
                                'niveau' => '[0-9]*',
                            ],
                        ],
                    ],   
                    'action-session-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add[/:id]', 
                            'defaults' => [  
                                'action' => 'add-session',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*$',
                            ],
                        ],
                    ],  
                    'actions-session-save' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/save[/:id]', 
                            'defaults' => [  
                                'action' => 'save-session',
                            ],  
                            'constraints' => [ 
                                'niveau' => '[0-9]*',
                            ],
                        ],
                    ], 
                    'selectoptionactpay' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/save[/:id]', 
                            'defaults' => [  
                                'action' => 'save-session',
                            ],  
                            'constraints' => [ 
                                'niveau' => '[0-9]*',
                            ],
                        ],
                    ],  
                   
                ],
    		],
            'etapes'=> [
                'type' =>  Literal::class,
                'options' => [
                    'route' => '/session/config/etape',
                    'defaults' => [
                        'controller' => Controller\MetaetapeController::class,
                        'action' => 'index',
                    ],
                ],
                'child_routes' => [
                    'actions-session-etape-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add-etape[/:id]',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'add-etape',
                            ],  
                            'constraints' => [ 
                                'niveau' => '[0-9]*',
                            ],
                        ],
                    ],
                    'actions-session-etape-management' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/management',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'index',
                            ],  
                             
                        ],
                    ],
                     
                    'actions-session-etape-tree' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/tree-etape',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'tree-metat-etape',
                            ],  
                             
                        ],
                    ],
                    'actions-session-etape-gestion' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/gestion-etape',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'gestion-meta-etape',
                            ],  
                             
                        ],
                    ],
                    
                    'actions-session-etape-lister' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/lister-etape[/:contexte]',   
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'lister-etape',
                            ],  
                            'constraints' => [ 
                                'contexte' => '[0-9]*',
                            ],
                             
                        ],
                    ],
                    'actions-session-etape-remove' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/remove-etape[/:id]',   
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'remove-etape',
                            ],  
                            'constraints' => [ 
                                'id' => '[0-9]*',
                            ],
                             
                        ],
                    ],
                    'actions-session-Metat-etape-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add-metat-etape[/:metacontexte][/:id]',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'add-metat-etape',
                            ],  
                            'constraints' => [ 
                                'niveau' => '[0-9]*',
                                'metacontexte'=>'[a-zA-Z0-9À-ž\s._-]*',
                            ],
                        ],
                    ],
                    'actions-session-Meta-etape-lister' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/lister-metat-etape[/:contexte]',   
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'lister-metat-etape',
                            ],  
                            'constraints' => [ 
                                'contexte' => '[0-9]*',
                            ],
                             
                        ],
                    ],
                    'actions-session-Meta-etape-contexte-lister' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/lister-etape-contexte[/:categorie]',   
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'lister-meta-etape-contexte',
                            ],  
                            'constraints' => [ 
                                'categorie' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                             
                        ],
                    ],
                    'actions-session-Meta-etape-contexte-add' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/add-meta-etape-contexte[/:categorie][/:id]',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'add-meta-etape-contexte',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*',
                                'categorie' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                        ],
                    ],
                    'actions-session-Meta-etape-contexte-save' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/save-meta-etape-contexte[/:categorie][/:id]',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'save-meta-etape-contexte',
                            ],  
                            'constraints' => [ 
                                'id' => '[a-zA-Z0-9À-ž\s._-]*',
                                'categorie' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                        ],
                    ], 
                    'actions-session-Meta-etape-contexte-gestion' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/gestion-meta-etape-contexte[/:categorie]',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'gestion-meta-etape-contexte',
                            ],  
                            'constraints' => [ 
                                'categorie' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                        ],
                    ],
                    'actions-session-Meta-etape-contexte-modifier' => [
                        'type' =>  Segment::class,
                        'options' => [
                            'route' => '/modifier-meta-etape-contexte[/:categorie][/:id]',  
                            'defaults' => [ 
                                'controller' => Controller\MetaetapeController::class,
                                'action' => 'modifier-meta-etape-contexte',
                            ],  
                            'constraints' => [ 
                                'categorie' => '[a-zA-Z0-9À-ž\s._-]*',
                                'id' => '[a-zA-Z0-9À-ž\s._-]*',
                            ],
                        ],
                    ],
                ]
            ],
          
    	],
    ],
    'controllers' => [
    	'factories' => [
            Controller\AdminController::class => Controller\Factory\AdminControllerFactory::class,
            Controller\CommunController::class=> Controller\Factory\CommunControllerFactory::class,
            Controller\DisplayController::class=> Controller\Factory\DisplayControllerFactory::class, 
            Controller\MetaetapeController::class=> Controller\Factory\MetaetapeControllerFactory::class, 
        ],
    ],
    'view_manager' => [
    	'template_map' => [ 
            'layout/layout'  => __DIR__ . '/../../../layouts/adminlte3/layout/layout.phtml',
               #admin
               'session/admin-index'   => __DIR__ . '/../view/sessionpreinscription/display/lister.phtml', 
               'session/admin-managment'   => __DIR__ . '/../view/sessionpreinscription/admin/gestion-session.phtml', 
               'session/admin-session-add'   => __DIR__ . '/../view/sessionpreinscription/admin/add.phtml', 
               'session/session-parametrage'   => __DIR__ . '/../view/sessionpreinscription/admin/parametrage.phtml', 

               #commun
               'session/management/tree-session'   => __DIR__ . '/../view/sessionpreinscription/communjson/jsonview.phtml', 
               'session/management/lister-session'   => __DIR__ . '/../view/sessionpreinscription/display/lister.phtml',  
              
               #display
               'session/link-session' => __DIR__ . '/../view/sessionpreinscription/display/link-session.phtml', 
    	
                #json
                'communjson/json-view'   => __DIR__ . '/../view/sessionpreinscription/communjson/jsonview.phtml',


                #MetaEtape
                'etapedebase/add'   => __DIR__ . '/../view/sessionpreinscription/etapedebase/add.phtml', 
                'etapedebase/gestion'   => __DIR__ . '/../view/sessionpreinscription/etapedebase/gestion.phtml', 
                'etapedebase/lister'   => __DIR__ . '/../view/sessionpreinscription/etapedebase/lister.phtml',
                'etape/Gestion'   => __DIR__ . '/../view/sessionpreinscription/metaetape/gestion-tree.phtml',



                'etape/add-metat'   => __DIR__ . '/../view/sessionpreinscription/metaetape/add.phtml',
                'etape/lister-metat'   => __DIR__ . '/../view/sessionpreinscription/metaetape/lister.phtml',
                'etape/Gestion-etape' => __DIR__ . '/../view/sessionpreinscription/metaetape/gestion-contexte-etape.phtml',


                #
                'etape/add-metat-contexte'   => __DIR__ . '/../view/sessionpreinscription/metaetape/add-contexte-etape.phtml',
                'etape/lister-metat-contexte'   => __DIR__ . '/../view/sessionpreinscription/metaetape/liste-contexte-etape.phtml',
                'etape/Gestion-Contexte' => __DIR__ . '/../view/sessionpreinscription/metaetape/gestion-contexte-etape.phtml',
                'etape/modifier-Contexte' => __DIR__ . '/../view/sessionpreinscription/metaetape/modifier-contexte-etape.phtml',

                #Preinscription metat etape
                 
                'etape/add-metat-preinscription'   => __DIR__ . '/../view/sessionpreinscription/metaetape/add-meta-etape-preinscription.phtml',
            ],
    	'template_path_stack' => [
    		'sessionpreinscription' => __DIR__ . '/../view'
    	]
    ], 
];
