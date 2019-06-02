<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class Polizza extends AbstractModel
{
    protected $mapping = [
        'id' => 'id',
        'idutente' => 'idutente',
        'numero' => 'numero',
        'compagnia' => 'compagnia',
        'dataemissione' => 'dataemissione',
        'datascadenza' => 'datascadenza',
        'premio' => 'premio',
        'tipo' => 'tipo',
    ];
}
