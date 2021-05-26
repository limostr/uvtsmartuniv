<?php 

declare(strict_types=1);

namespace Sessionpreinscription\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel;
use Formation\Model\Table\NiveauformationTable;
use Formation\Model\Table\FormationTable;
use Sessionpreinscription\Model\Table\sessionpreinscriptionTable; 
class CommunController   extends AbstractActionController
{
	 

    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }

	public function treeSessionAction(){
    	 
     
    	$allform=array();
    	$this->contructtreesession($allform);
    	$formation1["key"]= "GPERE_IDEtab";
    	$formation1["title"]= "Universite Virtuelle de Tunis";
    	$formation1["tooltip"]= "Universite Virtuelle de Tunis";
    	$formation1["folder"]= "true";
    	$formation1['children']=$allform;
    	$form[]=$formation1;
    	 
     

		$JsonModel =new JsonModel(array(
            "data"=>$form,
        ));

		$JsonModel->setTerminal(true);
	 	return $JsonModel->setTemplate("communjson/json-view");
    
    }

	private function contructtreesession(&$formation,$id=""){
    	// print_r($this->_userconnected->user);die();
    	$_FormationTable= new FormationTable( $this->adapter);
    	$_NiveauTable= new NiveauformationTable( $this->adapter);
    	if(empty($id)){
    		$listeformation=$_FormationTable->getThisFormation();
    	}else{
    		$listeformation=$_FormationTable->getThisFormation($id);
    	}
    	  
    	 
    	foreach ($listeformation as $key => $value){
    		$tmplist=$_FormationTable->getThisFormation($value['key']);
			//echo"<pre>";	print_r($tmplist);echo"</pre>";
    		if (is_array($tmplist) &&  empty($tmplist) ){
    			$formation1=array();
    			$formation1["key"]= "PERE_".$value['key'];
    			$formation1["title"]= $value['abrev'];
    			$formation1["tooltip"]= $value['value'];
    			$formation1["folder"]= "true";
				$formation1["iconclass"]="fa fa-book";
    			$niveau=array();
    			if(isset($this->_userconnected->user['roles']['superadmin'])){
    				$niveau=$_NiveauTable->getNiveau($value['key']);  
    			}else{
				$niveau=$_NiveauTable->getNiveau($value['key']/*,$this->_userconnected->user['idcompte']*/);
    				 
    			}
    			 
    			foreach ($niveau as $keyniv => $valniv){
    				$niv=array();
    				$niv["key"]= "NIV_".$valniv['idniveauformation']."_".$value['key'];
    				$niv["title"]=  $valniv['label'] ;
    				$niv["tooltip"]= $value['value'].'('.$valniv['label'].')' ;
    				$session=new SessionpreinscriptionTable( $this->adapter);
    				$sessionrec=$session->select("idniveauformation='".$valniv['idniveauformation']."' and idanneescolaire=".\Limostr\Tools\GenericParams::__getUnivYear($this->adapter));
    				if($sessionrec){    					
    					foreach ($sessionrec as $sessrow){
    						$sessarry=array();
    						$sessarry["key"]= "SESS_".$sessrow->idsessionpreinscription."_".$valniv['idniveauformation']."_".$value['key'];   						
							 
							$sessarry["title"]=!empty($sessrow->titresession) ? $sessrow->titresession :  date("d-M-Y",strtotime($sessrow->datedebut));
    						$sessarry["tooltip"]= $value['value'].'('.$valniv['label'].') : Date '.$sessrow->datedebut." ".$sessrow->idsessionpreinscription;
    						$sessarry["iconclass"]="fa fa-calendar";
							$niv["folder"]= "true";
    						$niv['children'][]=$sessarry;
    					}
    				}
    				
    				$formation1['children'][]=$niv;
    			}
    			$formation[]=$formation1;
    			$formation1=array();
    		}else{
    			$formation1=array();
    			$formation1["key"]= "PERE_".$value['key'];
    			$formation1["title"]= $value['abrev'];
    			$formation1["tooltip"]= $value['value'];
    			$formation1["folder"]= "true";
    			$formation1['children']=array();
    			$this->contructtreesession($formation1['children'],$value['key']);
    			$formation[]=$formation1;
    			 
    		}
    	}
    	 
    }
}