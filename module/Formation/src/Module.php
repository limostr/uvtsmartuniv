<?php

declare(strict_types=1);

namespace Formation;

use Laminas\Authentication\AuthenticationService;
use Laminas\Db\Adapter\Adapter;
use Laminas\Http\Response; # <- add this
use Laminas\Mvc\MvcEvent; # add this
use User\Model\Table\ForgotTable; 

class Module
{
    
	public function getConfig() : array
    {
        
        return include __DIR__ . '/../config/module.config.php';
    }

    # copy this and place in the Application\MOdule class
    public function onBootstrap(MvcEvent $event) 
    {
        if (!defined('SESSION_MODULE_ROOT')) {
            define('SESSION_MODULE_ROOT', realpath(__DIR__));
        }
        $app = $event->getApplication();
        $eventManager = $app->getEventManager();

        //$eventManager->attach($event::EVENT_DISPATCH, [$this, 'getAccessPrivileges']);
    }

    public function getServiceConfig(): array 
    {
    	return [
    		'factories' => [
                ForgotTable::class => function($sm) {
                    $dbAdapter = $sm->get(Adapter::class);
                    return new ForgotTable($dbAdapter);
                }, 
    		]
    	];
    }

     
}
