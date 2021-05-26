<?php 

declare(strict_types=1);

namespace Candidats\Controller;
  
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use RuntimeException; 
 
use Laminas\Db\Adapter\Adapter;
use Laminas\View\Renderer\PhpRenderer;

class EtapesfixeController extends AbstractActionController
{

    
    private $Container;
    private $adapter;

	public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
        $this->layout()->setTemplate('Candidat/index-layout');
    }


    public function diplomesAction(){
        
        
        $line_annee = new ViewModel();
        $line_annee->setTemplate('etapes-fixe/line-annee');

        $annee_etude = new ViewModel(); 
        $annee_etude->addChild($line_annee, 'line_annee');
        $annee_etude->setTemplate('etapes-fixe/annee-etude'); 

        $diplome = new ViewModel(); 
        $diplome->addChild($annee_etude, 'annee_etude') ;
        $diplome->setTemplate('etapes-fixe/diplome-etude'); 


        $view = new ViewModel();
        $view ->addChild($diplome, 'diplome'); 
        $view->setTerminal(true);
        $this->layout()->setTemplate('Candidat/index-layout');
		return $view->setTemplate('etapes-fixe/cycle-etude');
    }

    public function addLineYearsAction(){
        $nbrAnnees=$this->params()->fromRoute('nbr',"");
        $view = new ViewModel(['nbr'=> $nbrAnnees]);  
        $view->setTerminal(true);
        return $view->setTemplate('etapes-fixe/line-annee');
    }


    public function gestDiplomeAction(){
        
        $view = new ViewModel();  
        $this->layout()->setTemplate('Candidat/index-layout');
        return $view->setTemplate('etapes-fixe/gest-diplome');
    }
    public function mesdiplomeAction(){
        $view = new ViewModel();  
        $this->layout()->setTemplate('Candidat/index-layout');
        return $view->setTemplate('etapes-fixe/gest-diplome');
    }

    public function listeDiplomeAction(){




        $view = new ViewModel(["cycle1"=>[],"cycle2"=>[],"cycle3"=>[]]);  
         
        $view->setTerminal(true);
        return $view->setTemplate('etapes-fixe/liste-diplome');
    }
}