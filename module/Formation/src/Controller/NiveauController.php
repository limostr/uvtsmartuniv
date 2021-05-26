<?php 

declare(strict_types=1);

namespace Formation\Controller;


use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController; 
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel; 
class NiveauController   extends AbstractActionController
{
	
    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }
	public function managementAction()
	{ 
		
		$view =  new ViewModel(); 
		$this->layout()->setTemplate('layout/layout');
		return $view->setTemplate("formation/admin-managment");
	}

    public function indexAction()
    {
        
    }
    public function parametrageAction(){
    	 
		$id=$this->params()->fromRoute("id","");

    	$idFormation=explode("_", $id);
		$data=[];
    	if($idFormation[0]=="SESS"){
    		$data=['idformation'=>$idFormation[1], 'id'=>$id] ;
    	}
    	$view = new ViewModel($data);


		$view->setTerminal(true); 
		return $view->setTemplate('Niveau/Niveau-parametrage' );
    	
    }
}