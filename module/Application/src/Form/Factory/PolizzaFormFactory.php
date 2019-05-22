<?php

namespace Application\Form\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Application\Form\PolizzaForm;

class PolizzaFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $form = new PolizzaForm('polizza-form');
        $form->setAttribute('method', 'post');
        $form->addElements();
        $form->addInputFilter();
        return $form;
    }
}


