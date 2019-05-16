<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class Utente extends AbstractModel
{
    protected $mapping = [
        'id'        => 'id',
        'email'     => 'email',
        'password'  => 'password',
        'nome'      => 'nome',
        'cognome'   => 'cognome',
    ];
}
