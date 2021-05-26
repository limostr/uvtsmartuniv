<?php

declare(strict_types=1);

namespace Contexte\Model\Table;

use Contexte\Model\Entity\ContexteDbStructurejsonEntity;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway; 
use Laminas\Hydrator\ClassMethodsHydrator; # add this
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Paginator\Adapter\DbSelect; 
use Laminas\Paginator\Paginator;

class ContexteDbStructurejsonTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'contexte_dbstructurejson';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
	public function getAllStructure($contexte="")
	{
		 
		$sqlQuery = $this->sql->select()
		->join('contexte','contexte.idcontexte='.$this->table.'.idcontexte',['labelcontexte'],Select::JOIN_LEFT)
		->order('contexte.idcontexte ASC');

		if(!empty($role_id)){
			$sqlQuery->where("contexte.idcontexte='$contexte'");
		}
		 
		$classMethod = new ClassMethodsHydrator();
		$entity      = new ContexteDbStructurejsonEntity ();
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