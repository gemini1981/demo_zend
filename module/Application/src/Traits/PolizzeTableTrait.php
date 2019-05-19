<?php
namespace Application\Traits;

use Application\Model\PolizzeTable;

trait PolizzeTableTrait
{
    protected $PolizzeTable;

    public function setPolizzeTable(PolizzeTable $table)
    {
        $this->PolizzeTable = $table;
    }
}
