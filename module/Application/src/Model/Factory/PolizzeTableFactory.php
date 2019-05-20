<?php
namespace Application\Model\Factory;

use Application\Model\PolizzeTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;
use Application\Model\Polizza;

class PolizzeTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $table = new PolizzeTable();
        $table->setTableGateway($container->get(Adapter::class), new Polizza());
        return $table;
    }
}
