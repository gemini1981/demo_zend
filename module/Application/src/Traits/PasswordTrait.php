<?php
namespace Application\Traits;

use Zend\Crypt\Password\Bcrypt;

trait PasswordTrait
{
    public static function createHash($plainText)
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->create($plainText);
    }
    public static function verify($plainText, $hash)
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->verify($plainText, $hash);
    }
}
