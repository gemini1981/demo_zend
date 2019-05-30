<?php
namespace Application\Form;

use Zend\Form\Form;

class PolizzaForm extends Form
{

    public function addElements()
    {
        $this->add([
            'type'  => 'hidden',
            'name' => 'step',
            'attributes' => [
                'value' => '1',
            ]
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'numero',
            'options' => [
                'label' => 'Numero polizza',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'compagnia',
            'options' => [
                'label' => 'Compagnia',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'data_emissione',
            'options' => [
                'label' => 'Data emissione',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'data_scadenza',
            'options' => [
                'label' => 'Data scadenza',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'premio',
            'options' => [
                'label' => 'Premio',
            ],
        ]);

        $this->add([
            'name' => 'polizza_casa',
            'type' => PolizzaCasaFieldset::class,
        ]);

        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ],
        ]);

        $this->add([
            'type'  => 'submit',
            'name' => 'salva',
            'attributes' => [
                'value' => 'Salva',
                'id' => 'salva',
            ],
        ]);

        $this->add([
            'type'       => 'submit',
            'name'       => 'cancella',
            'attributes' => [
                'type'  => 'reset',
                'value' => 'Cancella',
                'id'    => 'cancella',
            ]
        ]);
    }

    public function addInputFilter()
    {
        // Create main input filter
        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name'     => 'numero',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 64
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'compagnia',
            'required' => true,
            'filters'  => [],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 6,
                        'max' => 64
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'data_emissione',
            'required' => true,
            'filters'  => [],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 10,
                        'max' => 10
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'data_scadenza',
            'required' => true,
            'filters'  => [],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 10,
                        'max' => 10
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'premio',
            'required' => true,
            'filters'  => [],
            'validators' => [
                [
                    'name' => 'Float',
                    'options' => [
                        'min' => 0.01,
                    ],
                ],
            ],
        ]);
    }
}
