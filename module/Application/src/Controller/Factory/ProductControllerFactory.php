<?php


namespace Application\Controller\Factory;

use Application\Controller\ProductController;
use Application\Service\ProductManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


/**
 * Class ProductControllerFactory
 * @package Application\Controller\Factory
 */
class ProductControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ProductController|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new ProductController($entityManager);
    }
}