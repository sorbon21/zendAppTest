<?php

namespace Application\View;


use Zend\Navigation\View\NavigationHelperFactory;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Helper\Navigation;
use Zend\View\Helper\Partial;

class TwigHelper implements ConfigInterface
{
    /**
     * Configure a service manager.
     *
     * Implementations should pull configuration from somewhere (typically
     * local properties) and pass it to a ServiceManager's withConfig() method,
     * returning a new instance.
     *
     * @param ServiceManager $serviceManager
     * @return ServiceManager
     */
    public function configureServiceManager(ServiceManager $serviceManager)
    {
        $config = $this->toArray();

        if (method_exists($serviceManager, 'configure')) {
            $serviceManager->configure($config);
            return $serviceManager;
        }

        foreach ($config['factories'] as $service => $factory) {
            $serviceManager->setFactory($service, $factory);
        }
        foreach ($config['aliases'] as $alias => $target) {
            $serviceManager->setAlias($alias, $target);
        }

        return $serviceManager;
    }

    /**
     * Return configuration for a service manager instance as an array.
     *
     * Implementations MUST return an array compatible with ServiceManager::configure,
     * containing one or more of the following keys:
     *
     * - abstract_factories
     * - aliases
     * - delegators
     * - factories
     * - initializers
     * - invokables
     * - lazy_services
     * - services
     * - shared
     *
     * In other words, this should return configuration that can be used to instantiate
     * a service manager or plugin manager, or pass to its `withConfig()` method.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'aliases' => [
                'navigation' => Navigation::class,
                'partial' => Partial::class
            ],
            'factories' => [
                Navigation::class => NavigationHelperFactory::class,
                Partial::class => InvokableFactory::class
            ]
        ];
    }
}