<?php
namespace LwcStaticPages\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PagesController extends AbstractActionController
{

   
    
    public function indexAction ()
    { 
         echo "no index specified yet";
         //@TODO: Implement Sitemap function here
         exit;
    }
    
    public function pageAction()
    {
        $page = $this->getEvent()->getRouteMatch()->getParam('page');
        $view = new ViewModel();
        //@todo intelligent language detection
        $language = $this->getServiceLocator()->get('translator')->getLocale();  
        $view->setTemplate('lwc-static-pages/pages/'.$language.'/'.$page.".phtml");
        return $view;
    }
    
    

   
}