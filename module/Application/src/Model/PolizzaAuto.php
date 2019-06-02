<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class PolizzaAuto extends AbstractModel
{
    protected $mapping = [
        'id' => 'id',
        'idpolizza' => 'idpolizza',
        'marca' => 'marca',
        'modello' => 'modello',
        'targa' => 'targa',
    ];
}
