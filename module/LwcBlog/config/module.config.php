<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'LwcBlog\Controller\Blog' => 'LwcBlog\Controller\BlogController',
            'LwcBlog\Controller\Admin' => 'LwcBlog\Controller\AdminController',
        ),
    ),    
    
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '[/:language]/blog[/:action][/:id][-:slug]',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(                        
                        'controller' => 'LwcBlog\Controller\Blog',
                        'action'     => 'index',
                    ),
                ),
            ),
            'blogadmin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '[/:language]/blog/admin[/:action][/:id]',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        
                        'controller' => 'LwcBlog\Controller\Admin',
                        'action'     => 'index',
                        
                    ),
                ),
            ),
            
            'blogindex' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '[/:language]/blog/index[/:page]',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]*',
                        'page'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'language' => 'en', //default language
                        'controller' => 'LwcBlog\Controller\Blog',
                        'action'     => 'index',
                    ),
                ),
            ),
            ///archives/84-Libra-CMS-install.html
            'blogarchive' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/archives[/:id][-:slug]',
                    'constraints' => array(
                        'language' => '[a-zA-Z0-9]2',
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'language' => 'en', //default language
                        'controller' => 'LwcBlog\Controller\Blog',
                        'action'     => 'archives',
                    ),
                ),
            ),
        ),
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            'lwcblog' => __DIR__ . '/../view',
        ),
        'strategies' => array(
	            'ViewFeedStrategy',	       
	    ),
    ),
);