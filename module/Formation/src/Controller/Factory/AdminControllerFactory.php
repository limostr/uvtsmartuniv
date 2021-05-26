<?php

declare(strict_types=1);

namespace Formation\Controller\Factory;

use Formation\Controller\AdminController;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface; 
 

class AdminControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new AdminController($container);
	}

	
}

