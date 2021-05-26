<?php

declare(strict_types=1);

namespace Preinscription;

 
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
    	'routes' => [
            'preinscription' => [
    			'type' => Literal::class,
    			'options' => [
    				'route' => '/preinscription/aide',
    				'defaults' => [
    					'controller' => Controller\AidesController::class,
    					'action' => 'index'
    				],
    			],
                'child_routes' => [
                    'actions-session-tree' => [
                        'type' =>  Literal::class,
                        'options' => [
                            'route' => '/formations', 
                            'defaults' => [ 
                                'controller' => Controller\AideController::class,
                                'action' => 'aide-formations',
                            ],  
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
    	'factories' => [
            Controller\AideController::class => Controller\Factory\AideControllerFactory::class,
            Controller\EtapesController::class=> Controller\Factory\EtapesControllerFactory::class,  
        ],
    ],
    'view_manager' => [
    	'template_map' => [ 
            'layout/layout'  => __DIR__ . '/../../../layouts/adminlte3/layout/layout.phtml',
               #admin
               'aides/aide-index'   => __DIR__ . '/../view/preinscription/aide/index.phtml',  
         ],
    	'template_path_stack' => [
    		'preinscription' => __DIR__ . '/../view'
    	]
    ], 
];