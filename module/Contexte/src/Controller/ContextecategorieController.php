<?php 

declare(strict_types=1);

namespace Contexte\Controller;

use Contexte\Form\Categorie\CategorieForm;
use Contexte\Model\Table\ContexteCategorieTable;
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel; 
use RuntimeException;
class ContextecategorieController   extends AbstractActionController
{
	 

    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }

	public function indexAction(){
		$CategorieTable=new ContexteCategorieTable($this->adapter);
		$ListeCategorie=$CategorieTable->getAllCategorie();

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeCategorie->setCurrentPageNumber($page);
		$ListeCategorie->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeCategorie' => $ListeCategorie]) ;
		$view->setTerminal(true);
		return $view->setTemplate('contexte/lister-Categorie');
	}

    public function addCategorieAction(){
        $CategorieForm = new CategorieForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
	 
		if(!empty($idParam)){
			$RessourceRable = new ContexteCategorieTable($this->adapter);
			$RecordCategorie=$RessourceRable->select("idcontextecategorie='$idParam'");
			if($rec=$RecordCategorie->current()){
				$CategorieForm->populateValues($rec);
			} 
		} 
		$view = new ViewModel(['form' => $CategorieForm,"id"=>$idParam]);


		$view->setTerminal(true); 
		return $view->setTemplate('contexte/categorie-add');
    }

    public function saveCategorieAction(){
		$categorieForm = new CategorieForm($this->adapter);
		$request = $this->getRequest();
	
	    if($request->isPost()) { 

			$categorieTable=new ContexteCategorieTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
	    	//$categorieForm->setInputFilter($categorieTable->getcategorieFormFilter());
	    	$categorieForm->setData($formData);

	    	if($categorieForm->isValid()) {
	    		try {
					$data = $categorieForm->getData();
					//$dataInsert['resource_id']=$data;
					$dataInsert['idcontextecategorie']=$data['idcontextecategorie'];
					$dataInsert['labelcontextecategorie']=$data['labelcontextecategorie'];
					$dataInsert['desccontextecategorie']=$data['desccontextecategorie']; 
                    $id=$this->params()->fromRoute("id","");
                    $reponse=['data'=>[]];
					if(!empty($id)){
                        $reponse = ['data' => ['status'=>'success','message'=>'la mise à jour du catégorie à été ajouter']];
						$categorieTable->update($dataInsert,['idcontextecategorie'=>$id]); 
					}else{
                        $reponse =['data' => ['status'=>'success','message'=>'Une nouvelle catégorie à été ajouter']];
						$categorieTable->insert($dataInsert); 
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
}