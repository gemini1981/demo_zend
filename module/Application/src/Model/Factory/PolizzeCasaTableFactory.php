<?php
namespace Application\Model\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;
use Application\Model\PolizzaCasa;
use Application\Model\PolizzeCasaTable;

class PolizzeCasaTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $table = new PolizzeCasaTable();
        $table->setTableGateway($container->get(Adapter::class), new PolizzaCasa());
        return $table;
    }
}
