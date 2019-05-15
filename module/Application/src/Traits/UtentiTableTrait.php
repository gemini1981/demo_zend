<?php
namespace Application\Traits;

use Application\Model\UtentiTable;

trait UtentiTableTrait
{
    protected $table;
    public function setTable(UtentiTable $table)
    {
        $this->table = $table;
    }
}
