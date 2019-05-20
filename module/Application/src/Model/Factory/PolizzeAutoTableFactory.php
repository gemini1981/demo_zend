<?php
namespace Application\Model\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;
use Application\Model\PolizzaAuto;
use Application\Model\PolizzeAutoTable;

class PolizzeAutoTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $table = new PolizzeAutoTable();
        $table->setTableGateway($container->get(Adapter::class), new PolizzaAuto());
        return $table;
    }
}
