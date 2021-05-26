<?php

declare(strict_types=1);

namespace Formation\Controller\Factory;

use Formation\Controller\NiveauController;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface; 
 

class NiveauControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new NiveauController($container);
	}

	
}

