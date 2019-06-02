<?php
namespace Application\Form;

use Zend\Form\Form;

class SelezionaTipoForm extends Form
{
    public function addElements()
    {

        $this->add([
            'type' => 'hidden',
            'name' => 'step',
            'attributes' => [
                'value' => 1,
            ],
        ]);

        $this->add([
            'type' => \Zend\Form\Element\Select::class,
            'name' => 'tipo',
            'options' => [
                'label' => 'Tipo polizza',
                'value_options' => [
                    'casa' => 'Casa',
                    'auto' => 'Auto',
                ],
            ],
        ]);

        // Add the CSRF field
        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ],
        ]);

        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'seleziona',
            'attributes' => [
                'value' => 'Seleziona',
                'id' => 'seleziona',
            ],
        ]);
    }

    public function addInputFilter()
    {
        // Create main input filter
        $inputFilter = $this->getInputFilter();

        // Add input for "email" field
        $inputFilter->add([
            'name'     => 'tipo',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
            ],
        ]);
    }
}
