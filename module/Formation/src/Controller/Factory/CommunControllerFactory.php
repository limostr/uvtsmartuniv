<?php

declare(strict_types=1);

namespace Formation\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Formation\Controller\CommunController; 

class CommunControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new CommunController($container);
	}
}
