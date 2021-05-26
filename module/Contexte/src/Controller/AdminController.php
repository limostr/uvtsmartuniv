<?php 

declare(strict_types=1);

namespace Contexte\Controller;

use Contexte\Form\Contexte\ContexteForm;
use Contexte\Model\Table\ContexteDbStructurejsonTable;
use Contexte\Model\Table\ContexteTable;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Filter\File\Rename;
use Laminas\View\Model\JsonModel;
use RuntimeException;
use User\Model\Table\UsersTable;
use User\Form\Setting\UploadForm; 

class AdminController   extends AbstractActionController
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
		
		$view =  new ViewModel(); 
		return $view->setTemplate("contexte/admin-managment");
	}
    
    public function listeContexteAction(){ 


        $ContexteTable=new ContexteTable($this->adapter); 
        
        $categorie_id=$this->params()->fromRoute('categorie',"");
        
        $ListeContexte=$ContexteTable->getAllContexte($categorie_id);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
       
        $ListeContexte->setCurrentPageNumber($page);
        $ListeContexte->setItemCountPerPage(5);
        
		

		$view =  new ViewModel(['ListeContexte' => $ListeContexte,'categorie_id'=>$categorie_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('contexte/lister-contexte');
    }

	 public function addContexteAction(){
        $ContextForm = new ContexteForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
        $categorie_id=$this->params()->fromRoute('categorie',"");

		if(!empty($idParam)){
			$RessourceRable = new ContexteTable($this->adapter);
			$RecordCategorie=$RessourceRable->select("idcontexte=$idParam");
			if($rec=$RecordCategorie->current()){
				$ContextForm->populateValues($rec);
			} 
		}else{
            $ContextForm->populateValues(['idcontextecategorie'=>$categorie_id]);
        }
		$view = new ViewModel(['form' => $ContextForm,"id"=>$idParam]);


		$view->setTerminal(true); 
		return $view->setTemplate('contexte/add');
     }

    public function removeContexteAction(){


        $contexte_id=$this->params()->fromRoute('id','');
        if(!empty($contexte_id))
        {
            try{
                $ContextTable = new ContexteTable($this->adapter);
                $contexteStructureTable= new ContexteDbStructurejsonTable($this->adapter);
                $contexteStructureTable->delete("idcontexte=$contexte_id");
                $ContextTable->delete("idcontexte=$contexte_id");

                $reponse =['data' => ['status'=>'success','message'=>'Suppression de contexte et les definition de structure associé effectuer avec suuccés']];
                $viewModel =new JsonModel($reponse);

                $viewModel->setTerminal(true);
                return $viewModel->setTemplate('Contexte-Communjson/json-view'); 

            } catch(RuntimeException $exception) {
                    $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
            
                    $viewModel->setTerminal(true);
                    return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
            }
            
        }else{
            $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>'pas de contexte a supprimé' ] ]  );
            
            $viewModel->setTerminal(true);
            return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
        }

    }
    public function saveContexteAction(){
        $contexteForm = new contexteForm($this->adapter);
		$request = $this->getRequest();
	
	    if($request->isPost()) { 

			$contexteTable=new ContexteTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
	    	//$contexteForm->setInputFilter($contexteTable->getcontexteFormFilter());
	    	$contexteForm->setData($formData);

	    	if($contexteForm->isValid()) {
	    		try {
					$data = $contexteForm->getData();
					//idcontexte, idcontextecategorie, labelcontexte, context_module, context_action, context_controller, infocontexte
					$dataInsert['idcontextecategorie']=$data['idcontextecategorie'];
					$dataInsert['labelcontexte']=$data['labelcontexte'];
					$dataInsert['context_module']=$data['context_module']; 
                    $dataInsert['context_action']=$data['context_action']; 
                    $dataInsert['context_controller']=$data['context_controller']; 
                    $dataInsert['desccontexte']=$data['desccontexte']; 
                    $id=$this->params()->fromRoute("id","");
                    $reponse=['data'=>[]];
					if(!empty($id)){
                        $reponse = ['data' => ['status'=>'success','message'=>'la mise à jour du catégorie à été ajouter']];
						$contexteTable->update($dataInsert,['idcontexte'=>$id]); 
					}else{
                        $reponse =['data' => ['status'=>'success','message'=>'Une nouvelle catégorie à été ajouter']];
						$contexteTable->insert($dataInsert); 
					}
					
					$viewModel =new JsonModel($reponse);

					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
	    		 
	    		} catch(RuntimeException $exception) {
					$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
			
					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
	    		}
	    	}
	    }
    }

    public function gestContexteAction(){
        $categorie_id=$this->params()->fromRoute('categorie',"");
        $view =  new ViewModel(['categorie' => $categorie_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('contexte/admin-menu');
    }



}