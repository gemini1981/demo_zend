<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class PolizzaAuto extends AbstractModel
{
    protected $mapping = [
        'id' => 'id',
        'id_polizza' => 'id_polizza',
        'marca' => 'marca',
        'modello' => 'modello',
        'targa' => 'targa',
    ];
}
