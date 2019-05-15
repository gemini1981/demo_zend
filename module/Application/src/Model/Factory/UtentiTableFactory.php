<?php
namespace Application\Model\Factory;

use Application\Model\Utente;
use Application\Model\UtentiTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;

class UtentiTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $table = new UtentiTable();
        $table->setTableGateway($container->get(Adapter::class), new Utente());
        return $table;
    }
}
