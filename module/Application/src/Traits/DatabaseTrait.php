<?php
namespace Application\Traits;

trait DatabaseTrait
{
    protected $database;

    public function setDatabase(\Zend\Db\Adapter\Adapter $database)
    {
        $this->database = $database;
    }
}
