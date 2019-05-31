<?php
namespace Application\Form;

use Zend\Form\Fieldset;

class PolizzaAutoFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'type' => 'text',
            'name' => 'marca',
            'options' => [
                'label' => 'Marca',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'modello',
            'options' => [
                'label' => 'Modello',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'targa',
            'options' => [
                'label' => 'Targa',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '',
            ],
        ]);
    }
}
