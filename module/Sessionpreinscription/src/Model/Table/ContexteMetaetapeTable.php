<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Paginator\Paginator;
use Sessionpreinscription\Model\Entity\ContexteMetaetapeEntity;

class ContexteMetaetapeTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'contexte_metaetape';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getAllMetatEtapes($contexte_id="")
	{
		 
		$sqlQuery = $this->sql->select()->join('contexte_categorie','contexte_categorie.idcontextecategorie='.$this->table.'.idcontextecategorie',['labelcontextecategorie'],Select::JOIN_LEFT) ; 
		if(!empty($contexte_id)){
			$sqlQuery->where("contexte_categorie.idcontextecategorie='$contexte_id'");
		}
		$classMethod = new ClassMethodsHydrator();
		$entity      = new ContexteMetaetapeEntity();
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