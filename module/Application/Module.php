<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $this->setupLocale($e);

    }
    
    public function setupLocale($e) {
        $eventManager        = $e->getApplication()->getEventManager();
        
        $routeCallback = function ($e) {            
            $availableLanguages = array ('de', 'en');
            $defaultLanguage = 'en';
            $language = "";
            $fromRoute = false;
            //see if language could be find in url
            if ($e->getRouteMatch()->getParam('language')) {
                $language = $e->getRouteMatch()->getParam('language');
                $fromRoute = true;                               
            
            //or use language from http accept    
            } else {
              $headers = $e->getApplication()->getRequest()->getHeaders();              
              if ($headers->has('Accept-Language')) {            
                    $headerLocale = $headers->get('Accept-Language')->getPrioritized();                    
                    $language = substr($headerLocale[0]->getLanguage(), 0,2);                    
              }
            }   
            if(!in_array($language, $availableLanguages) ) {
                $language = $defaultLanguage;
            }
            $e->getApplication()->getServiceManager()->get('translator')->setLocale($language);  
            
            //forward to localized url if not called with language parameter
            if($fromRoute !== true) {
                $actualRoute = $e->getRouteMatch();
                
                
                //this could be done with ZF methods in a lot more time, if you know how feel free to tell me
                $oldUrl = $_SERVER['REQUEST_URI'];
                if($oldUrl == '/') {
                    $oldUrl ="";
                }                
                //not for blog workarround
                if(strstr($oldUrl, 'blog') || strstr($oldUrl, 'user')) {
                    return true;
                }
                               
                $newUrl = $language . $oldUrl;
                header("Location: $newUrl");
                exit;
                
            }
        
        };
        
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE, $routeCallback);        
        
         
        
        
        
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
   
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
