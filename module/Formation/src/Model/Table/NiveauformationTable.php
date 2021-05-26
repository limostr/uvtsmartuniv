<?php

declare(strict_types=1);

namespace Formation\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Hydrator\ClassMethodsHydrator; # add this 
use Laminas\Db\Sql\Join;


class NiveauformationTable extends AbstractTableGateway
{
	protected $adapter;
	protected $table = 'niveauformation';

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}
 

	public function getNiveauSemestre($niveau){
		$selector=$this->sql->select(); 
		
			$selector->join("semestres", "semestres.idlevelformation=niveauformation.levelformation", Join::JOIN_LEFT);

		$selector->columns(array("key"=>"semestres.idsemestres","value"=>"semestres.label"));

		$selector->where("idniveauformation=".$niveau);
	 
		$record=$this->selectWith($selector); 
		if($record){
			return \Laminas\Stdlib\ArrayUtils::iteratorToArray($record);
		}else{
			return false;
		}

	}
	
	public function getNiveauoption($formation){
		$selector=$this->sql->select(); 


		$selector->join("formations", "formations.idformations=niveauformation.idformations", Join::JOIN_LEFT);

		$selector->columns(array("key"=>"idniveauformation","value"=>"niveauformation.label"));

		$selector->where("formations.idformations=".$formation);
		 
		$record=$this->selectWith($selector); 
		if($record){
			return \Laminas\Stdlib\ArrayUtils::iteratorToArray($record);
		}else{
			return false;
		}

	}
    
    public function getNiveau($idformation,$email="",$idtuteur=""){ 
    	
    	// echo $idcompteuser; 
    	$selector=$this->sql->select(); 
     	$selector->where("idformations='$idformation' AND activeniveau=TRUE");
    	if(!empty($idcompteuser)){
     	 $selector->where(" idniveauformation IN ( SELECT idniveauformation FROM responsableformation WHERE email='$email') ");
    	}elseif(!empty($idtuteur)){
			$idannee=\Limostr\Tools\GenericParams::__getUnivYear($this->adapter);
			     	 $selector->where(" idniveauformation 
							 IN (
								SELECT idniveauformation FROM 
								unite JOIN tutorats ON unite.idunite=tutorats.idunite 
								WHERE  
								email='$idtuteur'
								AND 
								idanneescolaire='$idannee'
							 ) 
					 ");
		}
    	
    	 
    	 $record=$this->selectWith($selector); 
    	if($record){
    		return \Laminas\Stdlib\ArrayUtils::iteratorToArray($record);
    	}else{
    		return array();
    	}
    }
	
	
	public function getAllNiveau(){
		$selector=$this->sql->select(); 
		
		$selector->join("formations", "formations.idformations=niveauformation.idformations", Join::JOIN_LEFT);
		
		$selector->columns(array(
								"codeniveau"=>"idniveauformation"
								,"labelniveau"=>"niveauformation.label"
								,"labelformation"=>"formations.label"
				));
	  
		$record=$this->selectWith($selector); 
		if($record){
			return \Laminas\Stdlib\ArrayUtils::iteratorToArray($record);
		}else{
			return false;
		}
		 
	}
		 
}