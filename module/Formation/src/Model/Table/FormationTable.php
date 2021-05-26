<?php

declare(strict_types=1);

namespace Formation\Model\Table;

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
    	
    	$selector->columns(array("key"=>"idformations","value"=>"label","abrev"=>"abrev"));
    	if(empty($idformation)){
    		$selector->where("idperformations IS NULL AND active=TRUE");
    	}else{
    		$selector->where("idperformations='$idformation' AND active=TRUE");
    	}
		$listformation= $this->selectWith($selector); 
    	if($listformation)
    	{
			return $listformation->toArray() ;
    		 
    	}else{
    		return array();
    	}
     
    	 
    }

	 
}