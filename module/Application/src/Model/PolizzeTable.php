<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeTable extends AbstractTable
{
    public static $tableName = 'polizze';

    public function findByIdUtente($id_utente)
    {
        return $this->tableGateway->select(['id_utente' => $id_utente]);
    }
    public function save(AbstractModel $polizza)
    {
        if ($polizza->getId()) {
            $where['id = ?'] = $polizza->getId();
            return $this->tableGateway->update($polizza->extract(), $where);
        }
        return $this->tableGateway->insert($polizza->extract());
    }
}
