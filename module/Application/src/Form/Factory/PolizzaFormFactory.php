<?php

namespace Application\Form\Factory;

use Application\Form\PolizzaCasaFieldset;
use Application\Form\PolizzaForm;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Form\PolizzaAutoFieldset;

class PolizzaFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $form = new PolizzaForm('polizza-form');
        $form->setAttribute('method', 'post');
        $form->addElements();
        $form->addInputFilter();

        $extra_fields = [
            'casa' => PolizzaCasaFieldset::class,
            'auto' => PolizzaAutoFieldset::class,
        ];
        $form->setExtraFieldsets($extra_fields);

        return $form;
    }
}
