<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Sessionpreinscription\Model\Entity\EtapeDeBaseEntity;
use Laminas\Db\Sql\Select;
use Laminas\Paginator\Adapter\DbSelect; 
use Laminas\Paginator\Paginator;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
use Laminas\Db\ResultSet\HydratingResultSet;
class EtapeDeBaseTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'etapedebase';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getAllEtapes($contexte_id="")
	{
		 
		$sqlQuery = $this->sql->select()
		->join('contexte','contexte.idcontexte='.$this->table.'.idcontexte',['labelcontexte'],Select::JOIN_LEFT);

		if(!empty($contexte_id)){
			$sqlQuery->where("contexte.idcontexte='$contexte_id'");
		}
		 
		$classMethod = new ClassMethodsHydrator();
		$entity      = new EtapeDeBaseEntity();
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