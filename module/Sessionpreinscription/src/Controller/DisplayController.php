<?php 

declare(strict_types=1);

namespace Sessionpreinscription\Controller;

use Formation\Model\Table\FormationTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Interop\Container\ContainerInterface;
use Sessionpreinscription\Model\Table\PlaningsessionpayementTable;
use Sessionpreinscription\Model\Table\SessionpreinscriptionTable;

class DisplayController   extends AbstractActionController
{
 
	private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }


	public function indexAction()
	{
		
	}

	public function linkSessionAction(){
		 
    	$data_mapper=new  SessionpreinscriptionTable($this->adapter);
		$PlaningsessionpayementTable=new PlaningsessionpayementTable($this->adapter);


    	 $annee=\Limostr\Tools\GenericParams::__getUnivYear();// $this->_getParam("anneescolaire");
    	 $niveau1=$this->params()->fromRoute("niveau","");  
    	 
    	 $niveau= explode ("_", $niveau1);
    	 if($niveau[0]=="NIV"){
    	 	$select=$data_mapper->getAllSession($annee,"",$niveau [1]); 
    	 }elseif($niveau[0]=="PERE"){ 
    	 	$formation= new  FormationTable($this->adapter);
    	 	$rec=$formation->select("idperformations=".$niveau [1]);
    	 	if($rec){
    	 		$liste=array();
    	 		foreach ($rec as   $value){
    	 			$liste[]=  $value->idformations ;
    	 		}
    	 	}
    	 	$select=$data_mapper->getAllSession($annee,$liste); 
			
    	 }else{
    	 	$select=$data_mapper->getAllSession($annee);
    	 }
		 //print_r($select);die();
		  
		 $view =    new   ViewModel(['idniv' => $niveau1,'sessionliste'=>$select,'PlaningPayementTable'=>$PlaningsessionpayementTable]);
		 $view->setTerminal(true);
		 return  $view->setTemplate('session/link-session'); 
	}
}