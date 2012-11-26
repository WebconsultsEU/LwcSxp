<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    
    
    public function indexAction()
    {
        /* $config = $this->getServiceLocator()->get('Config'); 
        \Zend\Debug\Debug::dump($config);exit; */
        
        $language = $this->getServiceLocator()->get('translator')->getLocale();  
        $view = new ViewModel();
        
        if($language == de) {
          $view->setTemplate('application/index/index-de.phtml');  
        }

        return $view;
    }
    
    
}
