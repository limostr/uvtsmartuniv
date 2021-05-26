<?php 

declare(strict_types=1);

namespace Candidats\Controller;
  
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use RuntimeException; 
 
use Laminas\Db\Adapter\Adapter; 
class EtapesController extends AbstractActionController
{

    
    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
        $this->layout()->setTemplate('Candidat/index-layout');
    }


    public function etapesMenuAction(){
        $view = new ViewModel();   
        $this->layout()->setTemplate('Candidat/index-layout');
		return $view->setTemplate('etapes/etape-menu');
    }

 
}