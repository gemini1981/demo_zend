<?php
namespace Application\Form;

use Zend\Form\Fieldset;

class PolizzaCasaFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'type' => 'text',
            'name' => 'citta',
            'options' => [
                'label' => 'Città',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'cap',
            'options' => [
                'label' => 'Cap',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'indirizzo',
            'options' => [
                'label' => 'Indirizzo',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'civico',
            'options' => [
                'label' => 'Civico',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);
    }
}
