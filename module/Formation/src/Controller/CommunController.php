<?php 

declare(strict_types=1);

namespace Formation\Controller;

 
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController; 
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel; 
use Formation\Model\Table\NiveauformationTable;
use Formation\Model\Table\FormationTable;
class CommunController   extends AbstractActionController
{
		 

    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }

	public function treeFormationAction(){
    	 
     
    	$allform=array();
    	$this->contructTreeFormation($allform);
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

	private function contructTreeFormation(&$formation,$id=""){
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
    			$this->contructTreeFormation($formation1['children'],$value['key']);
    			$formation[]=$formation1;
    			 
    		}
    	} 
    }  
}