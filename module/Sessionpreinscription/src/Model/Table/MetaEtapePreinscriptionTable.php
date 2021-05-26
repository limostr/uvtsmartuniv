<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway; 
 
 


class MetaEtapePreinscriptionTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'metaetapepreinscription';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
}