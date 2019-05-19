<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class PolizzeTable extends AbstractTable
{
    use \Application\Traits\PasswordTrait;

    public static $tableName = 'polizze';

    public function findByIdUtente($id_utente)
    {
        return $this->tableGateway->select(['id_utente' => $id_utente]);
    }
    public function save(AbstractModel $polizza)
    {
        if ($polizza->getId) {
            return $this->tableGateway->update($polizza->extract());
        }
        return $this->tableGateway->insert($polizza->extract());
    }
}
