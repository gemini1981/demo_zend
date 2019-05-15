<?php
namespace Application\Controller\Factory;

use Application\Controller\RegistrazioneController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;
use Application\Model\UtentiTable;

class RegistrazioneControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $controller = new RegistrazioneController;
        $controller->setDatabase($container->get(Adapter::class));
        $controller->setTable($container->get(UtentiTable::class));
        return $controller;
    }
}
