<?php

declare(strict_types=1);

namespace Sessionpreinscription\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Sessionpreinscription\Controller\CommunController; 

class CommunControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new CommunController($container);
	}
}
