<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

class UtentiTable extends AbstractTable
{
    use \Application\Traits\PasswordTrait;

    public static $tableName = 'utenti';

    public function findByEmail($email)
    {
        return $this->tableGateway->select(['email' => $email])->current();
    }
    public function save(AbstractModel $user)
    {
        $password = $user->getPassword();
        $user->setPassword(self::createHash($password));
        return $this->tableGateway->insert($user->extract());
    }
}
