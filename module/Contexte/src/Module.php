<?php

declare(strict_types=1);

namespace Contexte;

 
use Laminas\Mvc\MvcEvent; # add this 

class Module
{
    
	public function getConfig() : array
    {
        
        return include __DIR__ . '/../config/module.config.php';
    }

    # copy this and place in the Application\MOdule class
    public function onBootstrap(MvcEvent $event) 
    {
        if (!defined('CONTEXTE_MODULE_ROOT')) {
            define('CONTEXTE_MODULE_ROOT', realpath(__DIR__));
        }
        $app = $event->getApplication();
        $eventManager = $app->getEventManager();

        //$eventManager->attach($event::EVENT_DISPATCH, [$this, 'getAccessPrivileges']);
    }

     

     
}
