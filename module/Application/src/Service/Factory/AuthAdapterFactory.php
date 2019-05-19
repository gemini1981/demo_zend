<?php
namespace Application\Service\Factory;

use Interop\Container\ContainerInterface;
use Application\Service\AuthAdapter;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\Adapter;

class AuthAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $database = $container->get(Adapter::class);
        return new AuthAdapter($database);
    }
}
