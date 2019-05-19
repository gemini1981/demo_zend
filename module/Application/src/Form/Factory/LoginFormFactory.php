<?php

namespace Application\Form\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Application\Form\LoginForm;

class LoginFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $form = new LoginForm('login-form');
        $form->setAttribute('method', 'post');
        $form->addElements();
        $form->addInputFilter();
        return $form;
    }
}


