<?php
namespace Application\Traits;

use Application\Model\PolizzeTable;
use Application\Model\PolizzeCasaTable;
use Application\Model\PolizzeAutoTable;

trait PolizzeTableTrait
{
    protected $PolizzeTable;
    protected $PolizzeCasaTable;
    protected $PolizzeAutoTable;

    public function setPolizzeTable(PolizzeTable $table)
    {
        $this->PolizzeTable = $table;
    }
    public function setPolizzeCasaTable(PolizzeCasaTable $table)
    {
        $this->PolizzeCasaTable = $table;
    }
    public function setPolizzeAutoTable(PolizzeAutoTable $table)
    {
        $this->PolizzeAutoTable = $table;
    }
}
