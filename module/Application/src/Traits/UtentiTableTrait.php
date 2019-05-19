<?php
namespace Application\Traits;

use Application\Model\UtentiTable;

trait UtentiTableTrait
{
    protected $UtentiTable;

    public function setUtentiTable(UtentiTable $table)
    {
        $this->UtentiTable = $table;
    }
}
