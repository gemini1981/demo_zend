<?php
namespace Application\Form;

use Zend\Form\Fieldset;

class PolizzaCasaFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'type' => 'hidden',
            'name' => 'id_polizza',
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'citta',
            'options' => [
                'label' => 'Città',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'cap',
            'options' => [
                'label' => 'Cap',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'indirizzo',
            'options' => [
                'label' => 'Indirizzo',
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'civico',
            'options' => [
                'label' => 'Civico',
            ],
        ]);
    }
}
