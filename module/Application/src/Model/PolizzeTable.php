<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeTable extends AbstractTable
{
    public static $tableName = 'polizze';

    protected $lastId = null;

    public function getLastId()
    {
        return $this->lastId;
    }

    public function findByIdUtente($id_utente)
    {
        return $this->tableGateway->select(['idutente' => $id_utente]);
    }
    public function save(AbstractModel $polizza)
    {
        $premio = str_replace(',', '.', $polizza->getPremio());
        $polizza->setPremio($premio);
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
