<?php
namespace Application\Form;

use Zend\Form\Form;

class PolizzaForm extends Form
{
    protected $extra_fieldsets = [];

    public function addElements()
    {

        $this->add([
            'type' => 'hidden',
            'name' => 'step',
            'attributes' => [
                'value' => 2,
            ],
        ]);

        $this->add([
            'type' => 'hidden',
            'name' => 'id',
        ]);

        $this->add([
            'type' => 'hidden',
            'name' => 'tipo',
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'numero',
            'options' => [
                'label' => 'Numero polizza',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'compagnia',
            'options' => [
                'label' => 'Compagnia',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'dataemissione',
            'options' => [
                'label' => 'Data emissione',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'datascadenza',
            'options' => [
                'label' => 'Data scadenza',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'premio',
            'options' => [
                'label' => 'Premio',
            ],
        ]);

        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600,
                ],
            ],
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'salva',
            'attributes' => [
                'value' => 'Salva',
                'id' => 'salva',
            ],
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'cancella',
            'attributes' => [
                'type' => 'reset',
                'value' => 'Cancella',
                'id' => 'cancella',
            ],
        ]);
    }

    public function addElementExtra(string $extra)
    {
        $this->add([
            'name' => 'polizza_extra',
            'type' => $extra,
        ]);
    }

    public function addInputFilter()
    {
        // Create main input filter
        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name' => 'numero',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 64,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'compagnia',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 6,
                        'max' => 64,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'dataemissione',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 10,
                        'max' => 10,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'datascadenza',
            'required' => true,
            'filters' => [],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 10,
                        'max' => 10,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'premio',
            'required' => true,
            'filters' => [],
            // 'validators' => [
            //     [
            //         'name' => 'Float',
            //         'locale' => 'it_IT',
            //         'options' => [
            //             'min' => 0.01,
            //         ],
            //     ],
            // ],
        ]);
    }

    public function getExtraFieldsets()
    {
        return $this->extra_fieldsets;
    }

    public function setExtraFieldsets(array $extra_fieldsets)
    {
        $this->extra_fieldsets = $extra_fieldsets;
        return $this;
    }

    public function getExtraFieldsetsByField(string $field)
    {
        return $this->extra_fieldsets[$field] ?? null;
    }
}
