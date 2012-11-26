<?php
/*
 * TODO install the firephp class via composer
 * 
 * this is a possibility to use FIREPHP as Error Logger with ZF2,
 * not the best yet but working
 * 
 * 
 */

if(!class_exists("FirePHP")) {
    return array();
    //@TODO make error managment
    throw new \Exception("FirePHP class not loaded, this will not work");
    //install firephp through composer or manual
    
}

//firephp logger for all errors even fatal        
        $logger = new \Zend\Log\Logger();
        $writerFirebug = new \Zend\Log\Writer\FirePhp();
        $logger->addWriter($writerFirebug, 0);
        $logger->registerErrorHandler($logger);
        $logger->registerExceptionHandler($logger);
        $logger->info('Firephp logger initilized'.__FILE__.__LINE__);
        
//configure a shutdown function to log errors to firebug
        register_shutdown_function(function () use ($logger)
        {
            if ($e = error_get_last()) {
                //write error message
                $logger->ERR($e['message'] . " in " . $e['file'] . ' line ' . $e['line']);
                $logger->__destruct();
                //log configuraion to Firebug
                $logger->info(var_dump($this->getServiceLocator()->get('Config')));                
            }
        });
 return array (
         );