<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeCasaTable extends AbstractTable
{
    public static $tableName = 'polizze_casa';

    public function findByIdPolizza($id_polizza)
    {
        return $this->tableGateway->select(['id_polizza' => $id_polizza])->current();
    }
    public function save(AbstractModel $polizza_casa)
    {
        if ($polizza_casa->getId) {
            return $this->tableGateway->update($polizza_casa->extract());
        }
        return $this->tableGateway->insert($polizza_casa->extract());
    }
}
