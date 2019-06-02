<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeCasaTable extends AbstractTable
{
    public static $tableName = 'polizze_casa';

    protected $lastId = null;

    public function getLastId()
    {
        return $this->lastId;
    }

    public function findByIdPolizza($id_polizza)
    {
        return $this->tableGateway->select(['idpolizza' => $id_polizza])->current();
    }
    public function save(AbstractModel $polizza_casa)
    {
        if ($polizza_casa->getId()) {
            $where['id = ?'] = $polizza_casa->getId();
            $ret = $this->tableGateway->update($polizza_casa->extract(), $where);
        } else {
            $ret = $this->tableGateway->insert($polizza_casa->extract());
        }

        $this->lastId = $this->tableGateway->getLastInsertValue();

        return $ret;
    }
}
