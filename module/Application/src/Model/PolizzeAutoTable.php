<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeAutoTable extends AbstractTable
{
    public static $tableName = 'polizze_auto';

    protected $lastId = null;

    public function getLastId()
    {
        return $this->lastId;
    }

    public function findByIdPolizza($id_polizza)
    {
        return $this->tableGateway->select(['idpolizza' => $id_polizza])->current();
    }
    public function save(AbstractModel $polizza)
    {
        if ($polizza->getId()) {
            $where['id = ?'] = $polizza->getId();
            $ret = $this->tableGateway->update($polizza->extract(), $where);
        } else {
            $ret = $this->tableGateway->insert($polizza->extract());
        }

        $this->lastId = $this->tableGateway->getLastInsertValue();

        return $ret;
    }
}
