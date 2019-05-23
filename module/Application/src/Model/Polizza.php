<?php
namespace Application\Model;

use Application\Model\AbstractModel;

class Polizza extends AbstractModel
{
    protected $mapping = [
        'id' => 'id',
        'idutente' => 'id_utente',
        'numero' => 'numero',
        'compagnia' => 'compagnia',
        'dataemissione' => 'data_emissione',
        'datascadenza' => 'data_scadenza',
        'premio' => 'premio',
        'tipo' => 'tipo',
    ];
}
