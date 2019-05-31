<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class PolizzaCasa extends AbstractModel
{
    protected $mapping = [
        'id' => 'id',
        'idpolizza' => 'id_polizza',
        'citta' => 'citta',
        'cap' => 'cap',
        'indirizzo' => 'indirizzo',
        'civico' => 'civico',
    ];
}
