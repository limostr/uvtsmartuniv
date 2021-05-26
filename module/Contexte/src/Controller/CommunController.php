<?php 

declare(strict_types=1);

namespace Contexte\Controller;

use Contexte\Model\Table\ContexteCategorieTable;
use Contexte\Model\Table\ContexteDbStructurejsonTable;
use Contexte\Model\Table\ContexteTable;
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel;  

class CommunController   extends AbstractActionController
{
	 

    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }

	public function treeContexteAction(){
    	 
     
    	$allform=array();
    	$this->contructtreecontexte($allContexte);
    	$ContexteNodeRoot["key"]= "GPERE_Contexte";
    	$ContexteNodeRoot["title"]= "Contextes utiles";
    	$ContexteNodeRoot["tooltip"]= "Liste des categories/contexte/contexte structure";
    	$ContexteNodeRoot["folder"]= "true";
    	$ContexteNodeRoot['children']=$allContexte;
    	$form[]=$ContexteNodeRoot;
    	 
     

		$JsonModel =new JsonModel(array(
            "data"=>$form,
        ));

		$JsonModel->setTerminal(true);
	 	return $JsonModel->setTemplate("Contexte-Communjson/json-view");
    
    }

	private function contructtreecontexte(&$ContextesTree){
    	 
    	$_ContexteCategorieTable= new ContexteCategorieTable( $this->adapter);
    	$_ContexteTable= new ContexteTable( $this->adapter);
		$_ContextStructureTable=new ContexteDbStructurejsonTable( $this->adapter);
		$_ListeCategory=$_ContexteCategorieTable->select();
    	  
    	 
    	foreach ($_ListeCategory as $Category){
    		 
    		 
    			$CategoryNode=[];
    			$CategoryNode["key"]= "Category_".$Category->idcontextecategorie;
    			$CategoryNode["title"]= $Category->labelcontextecategorie;
    			$CategoryNode["tooltip"]=$Category->labelcontextecategorie;
    			$CategoryNode["folder"]= "true";
				$CategoryNode["iconclass"]="fa fa-book";
    			
				$_Contextes=$_ContexteTable->select("idcontextecategorie='".$Category->idcontextecategorie."'");
    		 
    			 
    			foreach ($_Contextes as $Contexte){
    				$ContextNode=[];
    				$ContextNode["key"]= "Contexte_".$Contexte->idcontexte."_".$Category->idcontextecategorie;
    				$ContextNode["title"]= $Contexte->labelcontexte ;
    				$ContextNode["tooltip"]= $Contexte->context_module."/".$Contexte->context_controller."/".$Contexte->context_action ;
    				
					$_ContextStructures=$_ContextStructureTable->select("idcontexte=".$Contexte->idcontexte);

     				if($_ContextStructures){    					
    					foreach ($_ContextStructures as $ContextStructure){
    						$ContextStructureNode=[];
    						$ContextStructureNode["key"]= "Structure_".$ContextStructure->idstructure."_".$Contexte->idcontexte."_".$Category->idcontextecategorie;   						
							 
							$ContextStructureNode["title"]=$ContextStructure->labelstructurecontexte;
    						$ContextStructureNode["tooltip"]= $ContextStructure->labelstructurecontexte;;
    						$ContextStructureNode["iconclass"]="fa fa-edit";
							$ContextNode["folder"]= "true";
    						$ContextNode['children'][]=$ContextStructureNode;
    					}
    				}
    				
    				$CategoryNode['children'][]=$ContextNode;
    			}
    			$ContextesTree[]=$CategoryNode;   		 
    	}
    	 
    }
	
}