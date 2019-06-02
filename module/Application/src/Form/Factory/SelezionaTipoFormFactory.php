<?php

namespace Application\Form\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Application\Form\SelezionaTipoForm;

class SelezionaTipoFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        $form = new SelezionaTipoForm('seleziona-tipo-form');
        $form->setAttribute('method', 'post');
        $form->setAttribute('action', '/admin/nuova');
        $form->addElements();
        $form->addInputFilter();
        return $form;
    }
}
