<?php
namespace Application\Model;

use Application\Model\AbstractTable;
use Application\Model\AbstractModel;

// use Zend\Hydrator\ClassMethods;
// use Zend\Db\ResultSet\HydratingResultSet;
// use Zend\Db\Adapter\Adapter;
// use Zend\Db\TableGateway\TableGateway;

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
        // var_dump($user);
        // var_dump($user->extract());
        // die;
        $password = $user->getPassword();
        $user->setPassword(self::createHash($password));
        return $this->tableGateway->insert($user->extract());
    }
}
