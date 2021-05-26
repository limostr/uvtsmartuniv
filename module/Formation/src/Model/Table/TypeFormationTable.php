<?php

declare(strict_types=1);

namespace Formation\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this 
 


class TypeFormationTable  extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'typeformation';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	} 
	 
}