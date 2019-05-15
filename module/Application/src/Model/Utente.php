<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class Utente extends AbstractModel
{
    protected $mapping = [
        'id'        => '',
        'email'     => '',
        'password'  => '',
        'nome'      => '',
        'cognome'   => '',
    ];
}
