<?php

declare(strict_types=1);

namespace Sessionpreinscription\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface; 
use Sessionpreinscription\Controller\DisplayController;

class DisplayControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new DisplayController($container);
	}
}
