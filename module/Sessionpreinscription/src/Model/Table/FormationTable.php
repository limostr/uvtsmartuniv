<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this
 
 


class FormationTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'formations';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

    public function getThisFormation($idformation="",$roles=false){
    	$selector=$this->sql->select(); 
    	
    	$selector->columns(["key"=>"idformations","value"=>"Label","abrev"=>"abrev"]);
    	if(empty($idformation)){
    		$selector->where("idperformations IS NULL AND active=1");
    	}else{
    		$selector->where("idperformations='$idformation' AND active=1");
    	}
    	// echo $selector->__toString();
    	$listformation=$this->fetchAll($selector);
    	if($listformation)
    	{
    	    return $listformation->toArray();
    	}else{
    		return array();
    	}  
    }
}