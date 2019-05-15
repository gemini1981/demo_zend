<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;
// use Login\Security\Password;
// use Zend\Hydrator\ClassMethods;
// use Zend\Db\ResultSet\HydratingResultSet;
// use Zend\Db\Adapter\Adapter;
// use Zend\Db\TableGateway\TableGateway;

class UtentiTable extends AbstractTable
{

    public static $tableName = 'utenti';
    public static $identityCol = 'email';
    public static $passwordCol = 'password';
    public function findByEmail($email)
    {
        return $this->tableGateway->select(['email' => $email])->current();
    }
    public function save(AbstractModel $user)
    {
        $password = $user->getPassword();
        $user->setPassword(Password::createHash($password));
        return $this->tableGateway->insert($user->extract());
    }
}
