<?php

declare(strict_types=1);

namespace Sessionpreinscription\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface; 
use Sessionpreinscription\Controller\MetaetapeController;

class MetaetapeControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new MetaetapeController($container);
	}
}
