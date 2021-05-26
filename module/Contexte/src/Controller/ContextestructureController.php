<?php 

declare(strict_types=1);

namespace Contexte\Controller;
 
use Contexte\Form\Structure\ContexteStructureForm; 
use Contexte\Model\Table\ContexteDbStructurejsonTable;
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel; 
use RuntimeException;
class ContextestructureController   extends AbstractActionController
{
	 

    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }

    public function addStructureAction(){
        $StructureForm = new ContexteStructureForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
        $contexte=$this->params()->fromRoute("contexte","");
		if(!empty($idParam)){
			$StructureTable = new ContexteDbStructurejsonTable($this->adapter);
			$RecordStructure=$StructureTable->select("idstructure=$idParam");
			if($rec=$RecordStructure->current()){
				$StructureForm->populateValues($rec);
			} 
		}else{
            $StructureForm->populateValues(["idcontexte"=> $contexte]);
        }
		$view = new ViewModel(['form' => $StructureForm,"id"=>$idParam]);


		$view->setTerminal(true); 
		return $view->setTemplate('contexte/add-structure');
    }

    public function saveStructureAction(){
		$StructureForm = new ContexteStructureForm($this->adapter);
		$request = $this->getRequest();
	
	    if($request->isPost()) { 

			$StructureTable=new ContexteDbStructurejsonTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
	    	//$StructureForm->setInputFilter($StructureTable->getStructureFormFilter());
	    	//$StructureForm->setData($formData);

	    	//if($StructureForm->isValid()) {
	    		try {
					//$data = $StructureForm->getData();
                    
					$dataInsert['formstructur']=$formData['formstructur'];
					$dataInsert['idcontexte']=$formData['idcontexte'];
					$dataInsert['labelstructurecontexte']=$formData['labelstructurecontexte']; 
                    $id=$this->params()->fromRoute("id","");
                    $reponse=['data'=>[]];
					if(!empty($id)){
                        $reponse = ['data' => ['status'=>'success','message'=>'la mise à jour du structure à été ajouter']];
						$StructureTable->update($dataInsert,['idstructure'=>$id]); 
					}else{
                        $reponse =['data' => ['status'=>'success','message'=>'Une nouvelle structure à été ajouter']];
						$StructureTable->insert($dataInsert); 
					}
					
					$viewModel =new JsonModel($reponse);

					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
	    		 
	    		} catch(RuntimeException $exception) {
					$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
			
					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
	    		}
	    	//}
	    }

	}


    public function removeStructureAction(){


        $idstructure=$this->params()->fromRoute('id','');
        if(!empty($contexte_id))
        {
            try{
                $ContextStructureTable = new ContexteDbStructurejsonTable($this->adapter); 
                $ContextStructureTable->delete("idstructure=$idstructure"); 

                $reponse =['data' => ['status'=>'success','message'=>'Suppression de  structure de contexte effectuer avec suuccés']];
                $viewModel =new JsonModel($reponse);

                $viewModel->setTerminal(true);
                return $viewModel->setTemplate('Contexte-Communjson/json-view'); 

            } catch(RuntimeException $exception) {
                    $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
            
                    $viewModel->setTerminal(true);
                    return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
            }
            
        }else{
            $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>'pas de structure contexte a supprimé' ] ]  );
            
            $viewModel->setTerminal(true);
            return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
        }

    }
    public function listerStructureAction(){
        $contexte_id=$this->params()->fromRoute("contexte",""); 

        $StructureTable=new ContexteDbStructurejsonTable($this->adapter);
		$ListeStructure=$StructureTable->getAllStructure($contexte_id);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeStructure->setCurrentPageNumber($page);
		$ListeStructure->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeStructure' => $ListeStructure,"contexte_id"=> $contexte_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('contexte/lister-Structure');
    }


    public function afficherFormAction(){
    }

    public function gestionStructureAction(){
     
        $id=$this->params()->fromRoute("id","");
        $view =  new ViewModel([ 'id'=>$id]); 
        $view->setTerminal(true);
		return $view->setTemplate('contexte/gestion-menu-structure');
    }
}