<?php

declare(strict_types=1);

namespace Candidats\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Candidats\Controller\EtapesController;
 
class EtapesControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		return new EtapesController($container);
	}
}
