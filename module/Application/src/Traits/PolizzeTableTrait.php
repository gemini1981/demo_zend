<?php
namespace Application\Traits;

use Application\Model\PolizzeTable;

trait PolizzeTableTrait
{
    protected $PolizzeTable;
    protected $PolizzeExtraTable;    

    public function setPolizzeTable(PolizzeTable $table)
    {
        $this->PolizzeTable = $table;
    }
    public function setPolizzeExtraTable(array $array_table)
    {
        $this->PolizzeExtraTable = $array_table;
    }    
}
