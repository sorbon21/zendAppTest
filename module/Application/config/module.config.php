<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\Factory\ProductControllerFactory;
use Application\Controller\ProductController;
use Application\Controller\UserController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
return [
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            Service\ProductManager::class=>Service\Factory\ProductManagerFactory::class,
            Service\UserManager::class=>Service\Factory\UserManagerFactory::class,
            TwigHelper::class => InvokableFactory::class
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type' => 'segment',
                'options' => [
                    'route'    => '/[:page]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'latest-products' => [
                'type' => 'segment',
                'options' => [
                    'route'    => '/latest-products[/:page]',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'latestProducts',
                    ],
                ],
            ],
            'product' => [
                'type' => 'segment',
                'options' => [
                    'route'    => '/product[/:id]',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'product',
                    ],
                ],
            ],
            'users' => [
                'type' => 'segment',
                'options' => [
                    'route'    => '/users[/:page]',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'user' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/user[[/:id]/:action[/:page]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action' => 'index'
                    ]
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            ProductController::class=>Controller\Factory\ProductControllerFactory::class,
            UserController::class=>Controller\Factory\UserControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,

        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
            //'layout_qualquer'           => __DIR__ . '/../view/layout/layout.twig',
            'application/index/index' => __DIR__ . '/../view/application/index/index.twig',
            'user/index/index' => __DIR__ . '/../view/user/index/index.twig',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'view_helpers' => [
        'aliases' => [
            'getClass' => View\Helper\GetClassHelper::class,
            'instanceOf' => View\Helper\InstanceOfHelper::class,
        ],
        'factories' => [
            View\Helper\GetClassHelper::class => InvokableFactory::class,
            View\Helper\InstanceOfHelper::class => InvokableFactory::class
        ],
    ],

];
