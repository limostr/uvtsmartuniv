<?php

declare(strict_types=1);

namespace Contexte\Model\Table;

use Contexte\Model\Entity\ContexteCategorieEntity;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway; 
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Paginator\Adapter\DbSelect; 
use Laminas\Paginator\Paginator;
use Laminas\Hydrator\ClassMethodsHydrator; # add this


class ContexteCategorieTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'contexte_categorie';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getAllCategorie(){
		$sqlQuery = $this->sql->select()->order('idcontextecategorie ASC');

	 
		$classMethod = new ClassMethodsHydrator();
		$entity      = new ContexteCategorieEntity();
		$resultSet   = new HydratingResultSet($classMethod, $entity);

		$paginatorAdapter = new DbSelect(
			$sqlQuery,
			$this->adapter,
			$resultSet
		);

		$paginator = new Paginator($paginatorAdapter); 
		return $paginator;
		 
	}
}