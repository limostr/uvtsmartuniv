<?php 

declare(strict_types=1);

namespace Candidats\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Filter\File\Rename; 
 

class DashboardController   extends AbstractActionController
{ 
	public function indexAction()
	{
        $this->layout()->setTemplate('Candidat/index-layout');
        $view = new ViewModel();
        $view->setTemplate('Candidat/dashboard');
		return  $view;
	}
}