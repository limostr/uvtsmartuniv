<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
use System\Model\Entity\AccessResourcesEntity; # add this
 


class SessionpreinscriptionTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'sessionpreinscription';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function fetchRessourceById(string $resource_id)
	{
		$sqlQuery = $this->sql->select()->where(['resource_id' => $resource_id]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler  = $sqlStmt->execute()->current();
	 
		if(!$handler) {
			return null;
		}
	 
		$hydrator = new ClassMethodsHydrator();
		$entity   = new AccessResourcesEntity(); 
		$hydrator->hydrate($handler, $entity);
 
		return $entity;
	}
 

	public function getAllSession($annee="",$formation="",$niveaux=""){
    
    	$selector=$this->sql->select() 
		->join("formations", "sessionpreinscription.idformations=formations.idformations",[
			"formationdesc"=>"description" 
			,'idformations'
			, 'idtypeformation'
			, 'idperformations'
			, 'codeformation'
			, 'abrev'
			, 'label'
			, 'diplome'
			 , 'description'
			 , 'modeformation'
			, 'active'  ])
		->join("niveauformation", "sessionpreinscription.idniveauformation=niveauformation.idniveauformation");
 
    	if(!empty($annee)){
    		$selector->where("idanneescolaire = '".$annee."'");
    	}
    	if(!empty($formation)){
    		if(is_array($formation)){
    			$selector->where("sessionpreinscription.idformations  IN (".implode(",", $formation) .")");
    		}else{
    			$selector->where("sessionpreinscription.idformations = '".$formation."'");
    		} 
    	} 
    	if(!empty($niveaux)){
    		$selector->where("sessionpreinscription.idniveauformation= '".$niveaux."'");
    	}
    
    	//echo $selector->__toString();
    	
     
	/*	 if(is_array($formation)){
		echo	$selector->getSqlString();die();
		} */
		
    	return   $this->executeSelect($selector)->toArray();
    }
	 
}