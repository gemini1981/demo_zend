<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Zend\Session\Storage\SessionArrayStorage;
return [
    'navigation' => [
        'default' => [
            ['label' => 'Home', 'route' => 'home',],
            ['label' => 'Registrazione', 'route' => 'registrazione',],
            ['label' => 'Login', 'route' => 'login',],
        ],
        'login' => [
            ['label' => 'Home', 'route' => 'home',],
            ['label' => 'Logout', 'route' => 'home',],
        ],
    ],
    'db' => [
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=demo;host=localhost',
    ],
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
    'session_config' => [
        'cookie_lifetime'     => 60*60*1, 
        'gc_maxlifetime'      => 60*60*24*30,        
    ],
];
