<?php

declare(strict_types=1);

namespace Preinscription\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Preinscription\Controller\AideController;
 
 
class AideControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new AideController($container);
	}
}
