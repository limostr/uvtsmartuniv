<?php

declare(strict_types=1);

namespace User\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Filter\File\Rename;
use User\Form\Profile\InfoArForm;
use User\Form\Profile\InfoFrForm;
use User\Model\Table\UsersTable;
use User\Form\Setting\UploadForm; 

class ProfileController extends AbstractActionController
{
	private $usersTable;
	private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    
		$this->usersTable = new UsersTable($this->adapter);
	}

	public function indexAction()
	{
		# ok now I am in the ProfileCOntroller
		# the reason I am here is because I want us to now display the profile picture

		$id = (string) $this->params()->fromRoute('id');
		$info = $this->usersTable->fetchAccountById((string) $id);
		if(!$info) {
			return $this->notFoundAction();
		}

    	return new ViewModel(['data' => $info]);
	}


 
	
	public function uploadimageAction(){
		 
		$uploadForm=  new UploadForm();
		
	 
	
		if($this->getRequest()->isPost()){
			if (!$uploadForm->isValid($_FILES)) {
				die("Photo non valide") ;
			}else{ 
				$filerecive=$uploadForm->fichier->receive();
				if ($filerecive) {
					$location = $uploadForm->fichier->getFileInfo(); 
					 
					// Uploading File
					 
						$locationFile = $uploadForm->fichier->getFileName();
						$extension = pathinfo($location['fichier']['name'], PATHINFO_EXTENSION);
						 
						$nameFile = 'profile.'.$extension;
						$fullPathNameFile = $location['fichier']['destination']."/".$nameFile;
					
						// Renommage du fichier
						unlink($fullPathNameFile);
						$filterRename = new Rename(array('target'=> $fullPathNameFile, 'overwrite' => false));
						$filterRename->filter($locationFile);
				 
						return $this->redirect()->toRoute('profile/cropimage',array('slug'=>'small',"imageName"=>$nameFile));
					 
				}else{
					die("Erreur de chargement ") ;
				}
			}
			
		}
 


		
		return new ViewModel(['form' => $uploadForm]);
	}
	
	public function profileimageAction(){ 
		$this->view->typetof=$this->_request->getParam("type"); 
	}

	public function mesInformationFrAction(){
		$form = new InfoFrForm($this->adapter); 
		$view = new ViewModel(["form"=>$form]); 
    
		$this->layout()->setTemplate('candidature/layout');
        return $view->setTemplate('user-info/info-perso-fr');
	}

	public function mesInformationArAction(){ 
		
		$form = new InfoArForm($this->adapter); 
		$view = new ViewModel(["form"=>$form]); 
   

		$this->layout()->setTemplate('candidature/layout');
        return $view->setTemplate('user-info/info-perso-ar');
	}


}
