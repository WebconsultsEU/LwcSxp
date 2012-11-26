<?php

$dbParams = array(
    'database'  => 'lwcblog',
    'username'  => 'root',
    'password'  => '',
    'hostname'  => 'localhost'
);


return array(
    'service_manager' => array(
        'aliases' => array(
            'dbAdapter' => 'Zend\Db\Adapter\Adapter'
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                $adapter = new Zend\Db\Adapter\Adapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
                ));

                //$adapter->setProfiler(new Zend\Db\Profiler\Profiler);
                //$adapter->injectProfilingStatementPrototype();
                return $adapter;
            },
        ),
    ),
);