<?php
namespace Application\Controller\Factory;

use Application\Controller\AdminController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Model\UtentiTable;
use Application\Model\PolizzeTable;

class AdminControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $controller = new AdminController;
        $controller->setAuthService($container->get(\Zend\Authentication\AuthenticationService::class));
        $controller->setPolizzeTable($container->get(PolizzeTable::class));
        $controller->setUtentiTable($container->get(UtentiTable::class));
        // $controller->setFormAdmin($container->get(AdminForm::class));
        return $controller;
    }
}
