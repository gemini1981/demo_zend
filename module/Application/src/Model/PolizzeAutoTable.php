<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeAutoTable extends AbstractTable
{
    public static $tableName = 'polizze_auto';

    public function findByIdPolizza($id_polizza)
    {
        return $this->tableGateway->select(['id_polizza' => $id_polizza])->current();
    }
    public function save(AbstractModel $polizza)
    {
        if ($polizza->getId) {
            return $this->tableGateway->update($polizza->extract());
        }
        return $this->tableGateway->insert($polizza->extract());
    }
}
