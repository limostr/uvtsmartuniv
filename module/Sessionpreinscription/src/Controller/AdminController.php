<?php 

declare(strict_types=1);

namespace Sessionpreinscription\Controller;
  
 
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use RuntimeException;
 
use Sessionpreinscription\Model\Table\SessionpreinscriptionTable;
use Sessionpreinscription\Form\Session\FormSessionpreinscript;
use Laminas\Db\Adapter\Adapter;
use Sessionpreinscription\Model\Table\CiblesTable;

class AdminController extends AbstractActionController
{

	private $adapter;    # database adapter

	public function __construct(Adapter $adapter)
	{ 
	 $this->adapter=$adapter;
	}



	 
	public function indexAction()
	{ 
		
		$view =  new ViewModel(); 
		return $view->setTemplate("session/admin-managment");
	}

	public function parametrageAction(){
    	 
		$id=$this->params()->fromRoute("id","");

    	$idsess=explode("_", $id);
		$data=[];
    	if($idsess[0]=="SESS"){
    		$data=['idsess'=>$idsess[1], 'id'=>$id] ;
    	}
    	$view = new ViewModel($data);


		$view->setTerminal(true); 
		return $view->setTemplate('session/session-parametrage');
    	
    }

 


	public function addSessionAction(){
    	
     
		$idsess=null;
		$idtest="";
    	$form= new FormSessionpreinscript($this->adapter);
		$id=$this->params()->fromRoute("id");
		if(!empty($id)){
			$idParam=$this->params()->fromRoute("id");
			$idsess = explode("_", $idParam); 
			$view['id']=$id;
		}
		
		if(is_array($idsess)){
			if($idsess[0]=='SESS'){
				$idtest=$idsess[2];
				$view['idsess']=$idsess[1];
				$view['idniv']=$idsess[2];
				$view['idformation']=$idsess[3];
			}elseif($idsess[0]=='NIV'){
				$idtest=$idsess[1];
				$view['idniv']=$idsess[1];
				$view['idformation']=$idsess[2];
			} 
		} 	
		
    	//$view['form']=$form;
    	
    	
		 $idnivselect='';
		
    	$view['idnivtest'] = $idtest;
		//$idsess=$this->params()->fromQuery("id");
    	//$idsess=explode("_", $idsess);
    	if(isset($idsess[0]) && $idsess[0]=='SESS'){
    		$model=new SessionpreinscriptionTable($this->adapter);
    		$data=$model->select('idsessionpreinscription =' . $idsess[1])->current(); 
			 
    		$datapopulate=array( 
    				 "datedebut"=>date('d-m-Y',strtotime($data['datedebut']))
    				,"datefin"=>date('d-m-Y',strtotime($data['datefin']))
    				,"nombredecandidats"=>$data['nombredecandidats']
    				,"lieu"=>$data['lieu']
    				,"description"=>$data['description']
    				,"mailtype"=>$data['description']
    				,"sujetmailtype"=>$data['sujetmailtype']
    				,"dateselection"=>$data['dateselection'] ? date('d-m-Y',strtotime($data['dateselection'])) : ''
    				,"dateentretient"=>$data['dateentretient'] ? date('d-m-Y',strtotime($data['dateentretient'])) : ''
    				,"datedeffusionresultat"=>$data['datedeffusionresultat'] ? date('d-m-Y',strtotime($data['datedeffusionresultat'])) : ''
    				,"datelisteattente"=>$data['datelisteattente'] ? date('d-m-Y',strtotime($data['datelisteattente'])) : ''
    				,"datedebutpay"=>$data['datedebutpay'] ?  date('d-m-Y',strtotime($data['datedebutpay'])): ''
    				,"datefinpay"=>$data['datefinpay'] ?  date('d-m-Y',strtotime($data['datefinpay'])): ''
    				,"activation"=>$data['activation']
    				,"semestre"=>$data['semestre']
    				,"nbrcandidat"=>$data['nbrcandidat']
    				,"periodesession"=>$data['periodesession']
    				,"nbrannee"=>$data['nbrannee'] 
					,"paiementdirect"=>$data['paiementdirect'] 
					,"titresession"=>$data['titresession'] 
					,"listedescin"=>$data['listedescin'] 
					,"listeemail"=>$data['listeemail'] 
					,"sessioncybler"=>$data['sessioncybler']
					 
    		);
			$cibles = new CiblesTable($this->adapter);
			$datacible=$cibles->select( 'idsessionpreinscription = ' . $idsess[1] );
			foreach($datacible as $cibl){
				$datapopulate['profiles'][]=$cibl->idprofiles;
			}
			$view['modelpay']= $data['modelpaiement'];
    		$form->populateValues($datapopulate);
    	} 
		$view['form']= $form;
		$viewTemplate =  new ViewModel($view) ;
		$viewTemplate->setTerminal(true);
		return $viewTemplate->setTemplate('session/admin-session-add');
    }
    
    public function saveSessionAction(){
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	 
    	if($this->_request->isPost()){
    		$formData = $this->_request->getPost();
    		 
    		$form= new FormSessionpreinscript($this->adapter);
    		if ($form->isValid( $formData)) {
    			try{
    				$dateselection = new \DateTime($form->getValue('dateselection'));
    				$dateentretient = new \DateTime($form->getValue('dateentretient'));
    				$datedeffusionresultat = new \DateTime($form->getValue('datedeffusionresultat'));
    				$datelisteattente = new \DateTime($form->getValue('datelisteattente'));
    					
    				$datedebut=new \DateTime($form->getValue('datedebut'));
    				$datefin=new \DateTime($form->getValue('datefin'));
    					
    				$datedebutpay= new \DateTime($form->getValue('datedebutpay'));
    				$datefinpay= new \DateTime($form->getValue('datefinpay'));
    					
    				 
    				$code_formulaire="";
    				 
    				$formData = $this->_request->getPost();
    					$tmp=$this->_getParam("idniv");
 						$idinfo=!empty($tmp) ? $this->_getParam("idniv") : $this->_getParam("idsess");
    					$idformation=explode("_", $idinfo);
    					 
    					$idsess=$idniveau=$idform="";
    					if($idformation[0]=='SESS'){
    						$idsess=$idformation[1];
    						$idniveau=$idformation[2];
    						$idform=$idformation[3];
    						
    					}else{
    						
    						$idniveau=$idformation[1];
    						$idform=$idformation[2];
    					}
    					$sessioncyb=$form->getValue('sessioncybler');
						if(is_array($sessioncyb)){
							$sessioncyb=$sessioncyb[1];
						} 
						$anneeunivselect=\Limostr\Tools\GenericParams::__getUnivYear($this->adapter);
						$data=array(
    						"idformations"=> $idform
    						,'anneeuniv'=> $anneeunivselect
    						,"idniveauformation"=>$idniveau
    						
    						
    						,"datedebut"=> $datedebut->format("Y-m-d")
    						,"datefin"=> $datefin->format("Y-m-d")
    						
    						,"dateselection"=> $dateselection->format("Y-m-d")
    						
    						,"idanneescolaire"=>$anneeunivselect
    						,"nombredecandidats"=> $form->getValue('nombredecandidats')
    						,"lieu"=> $form->getValue('lieu')
    						,"description"=> $form->getValue('description')
    						,"mailtype"=> $form->getValue('mailtype')
    						,"sujetmailtype"=> $form->getValue('sujetmailtype') 
    						,"titresession"=> $form->getValue('titresession') 
    						,"activation"=> $form->getValue('activation')
    						,"semestre"=> $form->getValue('semestre')
    						,"nbrcandidat"=> $form->getValue('nbrcandidat')
							,"nbrannee"=> $form->getValue('nbrannee')
							,"paiementdirect"=>$form->getValue('paiementdirect')
							
							,"listedescin"=>$form->getValue('listedescin')
							,"listeemail"=>$form->getValue('listeemail')
							,'sessioncybler'=>$sessioncyb 
    						
    						
    				); 
					 
					
					$tabpayement=array();
					if(isset($formData['paiementmodel']) && is_array($formData['paiementmodel'])){
						foreach($formData['paiementmodel'] as $keyp  => $valp){
							$tabpayement[]=array(
								"contrainte"=>$formData['paiementcontrainte'][$keyp]
								,"modelpaiement"=>$valp
							);
						}
					
						 
					}elseif(isset($formData['paiementmodel'])){
						 
							$tabpayement[]=array(
								"contrainte"=>$formData['paiementcontrainte'] 
								,"modelpaiement"=>$formData['paiementmodel']
							);
						 
					
						 
					}
					
					if(isset($formData['paiementmodel2']) && is_array($formData['paiementmodel2'])){
						foreach($formData['paiementmodel2'] as $keyp  => $valp){
							$tabpayement[]=array(
								"contrainte"=>$formData['paiementcontrainte2'][$keyp]
								,"modelpaiement"=>$valp
							);
						}
					
						 
					}elseif(isset($formData['paiementmodel2'])){
						 
							$tabpayement[]=array(
								"contrainte"=>$formData['paiementcontrainte2'] 
								,"modelpaiement"=>$formData['paiementmodel2']
							); 
					}
					 
					$data['modelpaiement']=\Laminas\Json\Json::encode($tabpayement);
					  
					
					
					  
    				$dbtable=new  SessionpreinscriptionTable();
    				if($this->params()->fromQuery("idsess")){
    					$dbtable->update($data,'idsessionpreinscription = '. $idsess) ;
    				}else {
    					$idsess=$dbtable->insert($data);  
    				}
					if($formData['profiles']){
						$cible= new CibleTable($this->adapter);
						$cible->delete(" idsessionpreinscription=$idsess");
						foreach($formData['profiles'] as $value){
							$data=array(
								'idprofiles'=>$value
								 ,'idsessionpreinscription'=>$idsess
							);
							$cible->insert($data);
						}
					}
    				$msgArray= ["status"=>"success","message"=>"Insertion effectué avec succée"];
    			}catch (RuntimeException $e) {
    	
    				$msgArray= ["status"=>"error","message"=>$e->getMessage()] ;
    			}
    	
    		}else{
				
				$errors=\Laminas\Json\Json::encode($form->formElementErrors());
				$msgArray= ["status"=>"error","message"=>"$errors"] ;
			}
    		 
    	}else{
			$msgArray= ["status"=>"error","message"=>"Not posted"] ;
			
		}

		$viewModel =new JsonModel( ['data'=> $msgArray] );
			
		$viewModel->setTerminal(true);
		return $viewModel->setTemplate('communjson/json-view'); 


	 
    }

	public function activsessionAction(){
    	  
    	$dataposted=$this->getRequest()->getPost();
    	if(isset($dataposted['id'])){
    		$activation = new SessionpreinscriptionTable();
    		$data=$activation->select("idsessionpreinscription=".$dataposted['id'])->current();
    		if($data['activation']){
    			$rec= $activation->update(array("activation"=>"FALSE"), "idsessionpreinscription=".$dataposted['id']);
    			echo  "<span class=\"badge badge-important\" title=\"Activer\"><i class=\"icon-eye-close icon-white\"></i></span>";
    		}else{
    			$rec= $activation->update(array("activation"=>"TRUE"), "idsessionpreinscription=".$dataposted['id']);
    			echo  "<span class=\"badge badge-success\" title=\"Activer\"><i class=\"icon-eye-open icon-white\"></i></span>";
    		}
    		  
    	}else{
    		echo "";
    	}
    	 
    }
}