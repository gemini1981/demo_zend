<?php
namespace Application\Traits;

trait PolizzeExtraTrait
{
    protected $PolizzeExtra;

    public function setPolizzeExtra(array $array_polizze_extra)
    {
        $this->PolizzeExtra = $array_polizze_extra;
    }
}
