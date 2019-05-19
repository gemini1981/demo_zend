<?php

namespace Application\Form\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Application\Form\RegistrazioneForm;
use Zend\Db\Adapter\Adapter;

class RegistrazioneFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $form = new RegistrazioneForm('registrazione-form');
        $form->setDatabase($container->get(Adapter::class));
        $form->setAttribute('method', 'post');
        $form->addElements();
        $form->addInputFilter();
        return $form;
    }
}


