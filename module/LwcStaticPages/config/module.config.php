<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'LwcStaticPages\Controller\Pages' => 'LwcStaticPages\Controller\PagesController',
        ),
    ),    
    
    'router' => array(
        'routes' => array(
            'page' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '[/:language]/page[/:page][/:slug]',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]{2}',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(                        
                        'controller' => 'LwcStaticPages\Controller\Pages',
                        'action'     => 'page',
                    ),
                ),
            ),
           'training' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '[/:language]/training',
                    'constraints' => array(
                        'language' => '[a-zA-Z][a-zA-Z0-9_-]*',                        
                    ),
                    'defaults' => array(                        
                        'controller' => 'LwcStaticPages\Controller\Pages',
                        'action'     => 'page',
                        'page'       => 'training',
                    ),
                ),
               
               
           ),//training
           'consulting' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '[/:language]/consulting',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]{2}',                        
                    ),
                    'defaults' => array(                        
                        'controller' => 'LwcStaticPages\Controller\Pages',
                        'action'     => 'page',
                        'page'       => 'consulting',
                    ),
                ),
               
               
           ),//consulting
           'development' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '[/:language]/development',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]{2}',                        
                    ),
                    'defaults' => array(
                        'language' => 'en', //default language                    
                        'controller' => 'LwcStaticPages\Controller\Pages',
                        'action'     => 'page',
                        'page'       => 'development',
                    ),
                ),
               
               
           ),//development
           'contact' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '[/:language]/contact',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]{2}',                        
                    ),
                    'defaults' => array(
                        
                        'controller' => 'LwcStaticPages\Controller\Pages',
                        'action'     => 'page',
                        'page'       => 'contact',
                    ),
                ),
               
               
           ),//contact 
            
        ),//routes
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            'lwcStaticPages' => __DIR__ . '/../view',
        ),
    ),
);