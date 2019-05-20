<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'registrazione' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/registrazione',
                    'defaults' => [
                        'controller' => Controller\RegistrazioneController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'admin' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/admin[/:action][/:id]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'access_filter' => [
        'controllers' => [
            'options' => [
                // The access filter can work in 'restrictive' (recommended) or 'permissive'
                // mode. In restrictive mode all controller actions must be explicitly listed 
                // under the 'access_filter' config key, and access is denied to any not listed 
                // action for not logged in users. In permissive mode, if an action is not listed 
                // under the 'access_filter' key, access to it is permitted to anyone (even for 
                // not logged in users. Restrictive mode is more secure and recommended to use.
                'mode' => 'restrictive'
            ],
            Controller\UserController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['resetPassword', 'message', 'setPassword'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
                ['actions' => ['index', 'add', 'edit', 'view', 'changePassword'], 'allow' => '@']
            ],
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\LoginController::class => Controller\Factory\LoginControllerFactory::class,
            Controller\RegistrazioneController::class => Controller\Factory\RegistrazioneControllerFactory::class,
            Controller\AdminController::class => Controller\Factory\AdminControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Form\RegistrazioneForm::class => Form\Factory\RegistrazioneFormFactory::class,
            Form\LoginForm::class => Form\Factory\LoginFormFactory::class,
            Model\UtentiTable::class => Model\Factory\UtentiTableFactory::class,
            Model\PolizzeTable::class => Model\Factory\PolizzeTableFactory::class,
            Model\PolizzeCasaTable::class => Model\Factory\PolizzeCasaTableFactory::class,
            Model\PolizzeAutoTable::class => Model\Factory\PolizzeAutoTableFactory::class,
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class,
            Service\AuthManager::class => Service\Factory\AuthManagerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
