<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway; 
 
 


class CiblesTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'cibles';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
}