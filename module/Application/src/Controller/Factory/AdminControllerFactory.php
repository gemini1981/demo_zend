<?php
namespace Application\Controller\Factory;

use Application\Controller\AdminController;
use Application\Form\PolizzaForm;
use Application\Model\PolizzeAutoTable;
use Application\Model\PolizzeCasaTable;
use Application\Model\PolizzeTable;
use Application\Model\UtentiTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Model\PolizzaCasa;
use Application\Model\PolizzaAuto;
use Application\Form\SelezionaTipoForm;

class AdminControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = new AdminController;
        $controller->setAuthService($container->get(\Zend\Authentication\AuthenticationService::class));
        $controller->setPolizzeTable($container->get(PolizzeTable::class));

        $controller->setPolizzeExtraTable([
            'casa' => $container->get(PolizzeCasaTable::class),
            'auto' => $container->get(PolizzeAutoTable::class),
        ]);

        $controller->setPolizzeExtra([
            'casa' => PolizzaCasa::class,
            'auto' => PolizzaAuto::class,
        ]);

        $controller->setUtentiTable($container->get(UtentiTable::class));

        $controller->setFormPolizza($container->get(PolizzaForm::class));
        $controller->setFormSelezionaTipo($container->get(SelezionaTipoForm::class));
        return $controller;
    }
}
