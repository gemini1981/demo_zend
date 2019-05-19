<?php
namespace Application\Controller\Factory;

use Application\Controller\RegistrazioneController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;
use Application\Model\UtentiTable;
use Application\Form\RegistrazioneForm;

class RegistrazioneControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $controller = new RegistrazioneController;
        $controller->setDatabase($container->get(Adapter::class));
        $controller->setTable($container->get(UtentiTable::class));
        $controller->setFormRegistrazione($container->get(RegistrazioneForm::class));
        return $controller;
    }
}
