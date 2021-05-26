<?php 

declare(strict_types=1);

namespace Sessionpreinscription\Controller;

use Contexte\Model\Table\ContexteCategorieTable;
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel; 
use Laminas\View\Model\JsonModel;
use Limostr\Tools\Template;
use RuntimeException;
use Sessionpreinscription\Form\Etape\EtapeDeBaseForm;
use Sessionpreinscription\Form\Etape\MetaEtapeForm;
use Sessionpreinscription\Form\Etape\MetaEtapePreinscriptionForm; 
use Sessionpreinscription\Model\Table\ContexteMetaetapeTable;
use Sessionpreinscription\Model\Table\EtapeDeBaseTable;
use Sessionpreinscription\Model\Table\MetaEtapePreinscriptionTable; 

class MetaetapeController   extends AbstractActionController
{
	 

    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }


    private function createTreeContexteMenu(){

        $CategorieTable=new ContexteCategorieTable($this->adapter);
        $ContexteTable=new ContexteMetaetapeTable($this->adapter);
        $MetaEtapeTable=new MetaEtapePreinscriptionTable($this->adapter);


        $CategoriRecords=$CategorieTable->select();
        if($CategoriRecords){
			foreach($CategoriRecords as $CategoriRecord){
                $ContexteRecords=$ContexteTable->select("idcontextecategorie='".$CategoriRecord->idcontextecategorie."'"); 
                if($ContexteRecords){
                    $ContexteTree=[];
                    foreach($ContexteRecords as $ContexteRecord){ 
                        $MetaEtapeRecords=$MetaEtapeTable->select("idcontextemetaetape='".$ContexteRecord->idcontextemetaetape."'");
                        $MetaEtapeTree=[];
                        foreach($MetaEtapeRecords as $MetaEtapeRecord){
                            $MetaEtapeTree[]=Template::NodeReturn("MetatEtapePre_".$MetaEtapeRecord->idmetaetapepreinscription."_".$ContexteRecord->idcontextemetaetape,$MetaEtapeRecord->labelmataetape,$MetaEtapeRecord->labelmataetape,"","false",[]);
                        }
                        
                        if(count($MetaEtapeTree)>0){
                            $ContexteTree[]=Template::NodeReturn("Contexte_".$ContexteRecord->idcontextemetaetape."_".$CategoriRecord->idcontextecategorie,$ContexteRecord->labelcontextemetaetape,$ContexteRecord->labelcontextemetaetape,"","true",$MetaEtapeTree);
                        }else{
                            $ContexteTree[]=Template::NodeReturn("Contexte_".$ContexteRecord->idcontextemetaetape."_".$CategoriRecord->idcontextecategorie,$ContexteRecord->labelcontextemetaetape,$ContexteRecord->labelcontextemetaetape,"","false",[]);
                        } 
                    }
                    if(count($ContexteTree)>0){
                        $tree[]=Template::NodeReturn("Categorie_".$CategoriRecord->idcontextecategorie,$CategoriRecord->labelcontextecategorie,$CategoriRecord->labelcontextecategorie,"","true",$ContexteTree);
                    }else{
                        $tree[]=Template::NodeReturn("Categorie_".$CategoriRecord->idcontextecategorie,$CategoriRecord->labelcontextecategorie,$CategoriRecord->labelcontextecategorie,"","false",[]);
                    } 
                }
                
            }
        } 
		

		return $Note[]=Template::NodeReturn("Root_ContexteEtape","Menu de l'application","Menu par Contexte","","true",$tree);
	}

    public function treeMetatEtapeAction(){
		
		$Nodes[]=$this->createTreeContexteMenu();
	  
		 $JsonModel =new JsonModel(array(
            "data"=>$Nodes,
        ));

		$JsonModel->setTerminal(true);
	 	return $JsonModel->setTemplate('communjson/json-view');

	}

    public function gestionMetaEtapeAction()
	{ 
		
		$view =  new ViewModel(); 
		return $view->setTemplate("etape/Gestion");
	}
    
    /**
     * indexAction Gestion des etape de base de preinscription
     *
     * @return void
     */
    public function indexAction()
	{
        $view = new ViewModel();   
		return $view->setTemplate('etapedebase/gestion');
	}

    
    /**
     * addEtapeAction Etape de base ajouter
     *
     * @return void
     */
    public function addEtapeAction()
	{
        $EtapeForm = new EtapeDeBaseForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
	 
		if(!empty($idParam)){
			$EtapeTable = new EtapeDeBaseTable($this->adapter);
			$RecordEtape=$EtapeTable->select("idetapedebase='$idParam'");
			if($rec=$RecordEtape->current()){
				$EtapeForm->populateValues($rec);
			} 
		} 
		$view = new ViewModel(['form' => $EtapeForm,"id"=>$idParam]); 
		$view->setTerminal(true); 
		return $view->setTemplate('etapedebase/add');
    }
    
    /**
     * listerEtapeAction Lister les etape de base
     *
     * @return void
     */
    public function listerEtapeAction()
	{
        $contexte_id=$this->params()->fromRoute("contexte","");
        $EtapesTable=new EtapeDeBaseTable($this->adapter);
		$ListeEtapes=$EtapesTable->getAllEtapes();

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeEtapes->setCurrentPageNumber($page);
		$ListeEtapes->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeEtapes' => $ListeEtapes,'contexte'=>$contexte_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('etapedebase/lister');
    }

	public function removeEtapeAction(){
		$idetaped=$this->params()->fromRoute('id','');
        if(!empty($contexte_id))
        {
            try{
                $EtapesTable = new EtapeDeBaseTable($this->adapter); 
                $EtapesTable->delete("idetaped=$idetaped"); 

                $reponse =['data' => ['status'=>'success','message'=>"Suppression de  l'etape effectuer avec suuccés"]];
                $viewModel =new JsonModel($reponse);

                $viewModel->setTerminal(true);
                return $viewModel->setTemplate('communjson/json-view'); 

            } catch(RuntimeException $exception) {
                    $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
            
                    $viewModel->setTerminal(true);
                    return $viewModel->setTemplate('communjson/json-view'); 
            }
            
        }else{
            $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>"pas d'etape a supprimé" ] ]  );
            
            $viewModel->setTerminal(true);
            return $viewModel->setTemplate('communjson/json-view'); 
        }
    }









/**
     * addEtapeAction Etape de préinscription ajouter
     *
     * @return void
     */
    public function addMetatEtapeAction()
	{
        $EtapeForm = new MetaEtapePreinscriptionForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
        $idmetacontexte=$this->params()->fromRoute("metacontexte","");
		if(!empty($idParam)){
			$EtapeTable = new MetaEtapePreinscriptionTable($this->adapter);
			$RecordEtape=$EtapeTable->select("idmetaetapepreinscription='$idParam'");
			if($rec=$RecordEtape->current()){
				$EtapeForm->populateValues($rec);
			} 
		}else{
            $EtapeForm->populateValues(['idcontextemetaetape'=> $idmetacontexte]);
        }
		$view = new ViewModel(['form' => $EtapeForm,"id"=>$idParam]); 
		$view->setTerminal(true); 
		return $view->setTemplate('etape/add-metat-preinscription');
    }
    
    /**
     * listerEtapeAction Lister les etape de base
     *
     * @return void
     */
    public function listerMetatEtapeAction()
	{
        $contexte_id=$this->params()->fromRoute("contexte","");
        $EtapesTable=new ContexteMetaetapeTable($this->adapter);
		$ListeEtapes=$EtapesTable->getAllEtapes();

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeEtapes->setCurrentPageNumber($page);
		$ListeEtapes->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeEtapes' => $ListeEtapes,'contexte'=>$contexte_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('etapedebase/lister');
    }

	public function removeMetatEtapeAction(){
		$idetaped=$this->params()->fromRoute('id','');
        if(!empty($contexte_id))
        {
            try{
                $EtapesTable = new ContexteMetaetapeTable($this->adapter); 
                $EtapesTable->delete("idetaped=$idetaped"); 

                $reponse =['data' => ['status'=>'success','message'=>"Suppression de contexte de l'etape effectuer avec suuccés"]];
                $viewModel =new JsonModel($reponse);

                $viewModel->setTerminal(true);
                return $viewModel->setTemplate('communjson/json-view'); 

            } catch(RuntimeException $exception) {
                    $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
            
                    $viewModel->setTerminal(true);
                    return $viewModel->setTemplate('communjson/json-view'); 
            }
            
        }else{
            $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>"pas d'etape a supprimé" ] ]  );
            
            $viewModel->setTerminal(true);
            return $viewModel->setTemplate('communjson/json-view'); 
        }
    }







    /**
     * addEtapeAction Etape de base ajouter
     *
     * @return void
     */
    public function addMetaEtapeContexteAction()
	{
        $EtapeForm = new MetaEtapeForm($this->adapter);
		$idParam=$this->params()->fromRoute("id","");
        $idCategorie=$this->params()->fromRoute("categorie","");
		if(!empty($idParam)){
			$EtapeTable = new ContexteMetaetapeTable($this->adapter);
			$RecordEtape=$EtapeTable->select("idcontextemetaetape='$idParam'");
			if($rec=$RecordEtape->current()){
				$EtapeForm->populateValues($rec);
			} 
		}else{
            $EtapeForm->populateValues(['idcontextecategorie'=>$idCategorie]);
        }
		$view = new ViewModel(['form' => $EtapeForm,"id"=>$idParam,"categorie"=>$idCategorie]); 
		$view->setTerminal(true); 
		return $view->setTemplate('etape/add-metat-contexte');
    }
    
    /**
     * listerEtapeAction Lister les etape de base
     *
     * @return void
     */
    public function listerMetaEtapeContexteAction()
	{
        $contexte_id=$this->params()->fromRoute("categorie",""); 
        $EtapesTable=new ContexteMetaetapeTable($this->adapter);
		$ListeEtapes=$EtapesTable->getAllMetatEtapes($contexte_id);

		$page = (int) $this->params()->fromQuery('page', 1); # sorry i forgot this line..
		$page = ($page < 1) ? 1 : $page;
		$ListeEtapes->setCurrentPageNumber($page);
		$ListeEtapes->setItemCountPerPage(5);

		$view =  new ViewModel(['ListeEtapes' => $ListeEtapes,'contexte_id'=>$contexte_id]) ;
		$view->setTerminal(true);
		return $view->setTemplate('etape/lister-metat-contexte');
    }
    public function saveMetaEtapeContexteAction()
	{
        $categorieForm = new MetaEtapeForm($this->adapter);
		$request = $this->getRequest();
	
	    if($request->isPost()) { 

			$ContexteMetaetape=new ContexteMetaetapeTable($this->adapter);
	    	$formData = $request->getPost()->toArray();
	    	//$categorieForm->setInputFilter($ContexteMetaetape->getcategorieFormFilter());
	    	$categorieForm->setData($formData);

	    	if($categorieForm->isValid()) {
	    		try {
                    //idcontextemetaetape, labelcontextemetaetape, desccontextemetaetape, idcontextecategorie
					$data = $categorieForm->getData(); 
					$dataInsert['idcontextemetaetape']=$data['idcontextemetaetape'];
					$dataInsert['labelcontextemetaetape']=$data['labelcontextemetaetape'];
					$dataInsert['desccontextemetaetape']=$data['desccontextemetaetape']; 
                    $dataInsert['idcontextecategorie']=$data['idcontextecategorie']; 

                    $id=$this->params()->fromRoute("id","");
                    $reponse=['data'=>[]];
					if(!empty($id)){
                        $reponse = ['data' => ['status'=>'success','message'=>'la mise à jour du contexte etape à été ajouter']];
						$ContexteMetaetape->update($dataInsert,['idcontextemetaetape'=>$id]); 
					}else{
                        $reponse =['data' => ['status'=>'success','message'=>'Une nouvelle contexte etape à été ajouter']];
						$ContexteMetaetape->insert($dataInsert); 
					}
					
					$viewModel =new JsonModel($reponse);

					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('Contexte-Communjson/json-view'); 
	    		 
	    		} catch(RuntimeException $exception) {
					$viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
			
					$viewModel->setTerminal(true);
					return $viewModel->setTemplate('communjson/json-view'); 
	    		}
	    	}
	    }
    }

	public function removeMetaEtapeContexteAction(){
		$idetaped=$this->params()->fromRoute('id','');
        if(!empty($contexte_id))
        {
            try{
                $EtapesTable = new ContexteMetaetapeTable($this->adapter); 
                $EtapesTable->delete("idetaped=$idetaped"); 

                $reponse =['data' => ['status'=>'success','message'=>"Suppression de contexte de l'etape effectuer avec suuccés"]];
                $viewModel =new JsonModel($reponse);

                $viewModel->setTerminal(true);
                return $viewModel->setTemplate('communjson/json-view'); 

            } catch(RuntimeException $exception) {
                    $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>$exception->getMessage() ] ]  );
            
                    $viewModel->setTerminal(true);
                    return $viewModel->setTemplate('communjson/json-view'); 
            }
            
        }else{
            $viewModel =new JsonModel( ['data'=> [ 'status'=>'error', 'message'=>"pas d'etape a supprimé" ] ]  );
            
            $viewModel->setTerminal(true);
            return $viewModel->setTemplate('communjson/json-view'); 
        }
    }
    public function gestionMetaEtapeContexteAction()
	{  
		
        $categorie_id=$this->params()->fromRoute('categorie','');
        $view =  new ViewModel(['categorie_id'=>$categorie_id]); 
        $view->setTerminal(true);
		return $view->setTemplate("etape/Gestion-Contexte");
	}
    public function modifierMetaEtapeContexteAction()
	{  
		
        $categorie_id=$this->params()->fromRoute('categorie','');
        $id=$this->params()->fromRoute('id','');
        $view =  new ViewModel(['categorie_id'=>$categorie_id,'id'=>$id]); 
        $view->setTerminal(true);
		return $view->setTemplate("etape/modifier-Contexte");
	}
}