<?php
namespace Application\Controller\Factory;

use Application\Controller\LoginController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Form\LoginForm;
use Application\Service\AuthManager;

class LoginControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $controller = new LoginController;
        $controller->setAuthManager($container->get(AuthManager::class));
        $controller->setFormLogin($container->get(LoginForm::class));
        return $controller;
    }
}
