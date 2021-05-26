<?php

declare(strict_types=1);

namespace Contexte\Model\Table;



use Contexte\Model\Entity\ContexteEntity;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway; 
use Laminas\Db\Sql\Select;
use Laminas\Paginator\Adapter\DbSelect; 
use Laminas\Paginator\Paginator;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
use Laminas\Db\ResultSet\HydratingResultSet;

class ContexteTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'contexte';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function getAllContexte($categorie="")
	{
		 
		$sqlQuery = $this->sql->select()
		->join('contexte_categorie','contexte_categorie.idcontextecategorie='.$this->table.'.idcontextecategorie',['labelcontextecategorie'],Select::JOIN_LEFT)
		->order('contexte_categorie.idcontextecategorie ASC');

		if(!empty($role_id)){
			$sqlQuery->where("contexte_categorie.idcontextecategorie='$categorie'");
		}
		 
		$classMethod = new ClassMethodsHydrator();
		$entity      = new ContexteEntity();
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