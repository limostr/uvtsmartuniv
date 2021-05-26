<?php

declare(strict_types=1);

namespace Contexte\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;  
use Contexte\Controller\ContextecategorieController;

class ContextecategorieControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new ContextecategorieController($container);
	}
}
