<?php
/**
 * This form is used to collect user's personal information and address.
 */
namespace Application\Form;

use Zend\Form\Form;

/**
 * This form is used to collect user's personal information and address.
 * This data is intended to be used when registering a new user.
 */
class RegistrazioneForm extends Form
{
    use \Application\Traits\DatabaseTrait;

    public function addElements()
    {

        // Campo Nome
        $this->add([
            'type'  => 'text',
            'name' => 'nome',
            'attributes' => [
                'id' => 'nome'
            ],
            'options' => [
                'label' => 'Nome',
            ],
        ]);

        // Cognome
        $this->add([
            'type'  => 'text',
            'name' => 'cognome',
            'attributes' => [
                'id' => 'cognome'
            ],
            'options' => [
                'label' => 'Cognome',
            ],
        ]);


        // Campo Email
        $this->add([
            'type'  => 'text',
            'name' => 'email',
            'attributes' => [
                'id' => 'email'
            ],
            'options' => [
                'label' => 'E-mail',
            ],
        ]);


        // Campo Password
        $this->add([
            'type'  => 'password',
            'name' => 'password',
            'attributes' => [
                'id' => 'password'
            ],
            'options' => [
                'label' => 'Password',
            ],
        ]);

        // Campo Conferma Password
        $this->add([
            'type'  => 'password',
            'name' => 'conferma_password',
            'attributes' => [
                'id' => 'conferma_password'
            ],
            'options' => [
                'label' => 'Conferma password',
            ],
        ]);

        // Add the CSRF field
        $this->add([
            'type'  => 'csrf',
            'name' => 'csrf',
            'attributes' => [],
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ],
        ]);

        // Add the submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'registra',
            'attributes' => [
                'value' => 'Registra',
                'id'    => 'registra',
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
        $inputFilter = $this->getInputFilter();


        $inputFilter->add([
            'name'     => 'nome',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 50
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'cognome',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 50
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'email',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck'    => false,
                    ],
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => [
                        'table' => 'utenti',
                        'field' => 'email',
                        'adapter' => $this->database,
                        'exclude' => array(
                            'field' => 'email',
                            'value' => ['email'],
                        ),
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'password',
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
            'name'     => 'conferma_password',
            'required' => true,
            'filters'  => [],
            'validators' => [
                [
                    'name'    => 'Identical',
                    'options' => [
                        'token' => 'password',
                    ],
                ],
            ],
        ]);
    }
}
