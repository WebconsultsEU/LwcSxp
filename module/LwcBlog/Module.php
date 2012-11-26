<?

namespace LwcBlog;

use LwcBlog\Model\EntryTable;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

        public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'lwc_blog_module_options' => function ($sm) {
                    $config = $sm->get('Config');                      
                    return new Options\ModuleOptions(isset($config['LwcBlog']) ? $config['LwcBlog'] : array());
                },
                       
                'LwcBlog\Model\EntryTable' => function  ($sm)
                {
                    return new EntryTable($sm->get('dbAdapter'));
                },
                
        ));
    
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    
    
}