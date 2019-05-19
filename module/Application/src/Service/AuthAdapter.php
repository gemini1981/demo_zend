<?php
namespace Application\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Adapter\Adapter;

/**
 * Adapter used for authenticating user. It takes login and password on input
 * and checks the database if there is a user with such login (email) and password.
 * If such user exists, the service returns its identity (email). The identity
 * is saved to session and can be retrieved later with Identity view helper provided
 * by ZF3.
 */
class AuthAdapter implements AdapterInterface
{
    private $email;
    
    private $password;
    
    private $database;
        
    public function __construct($database)
    {
        $this->database = $database;
    }
    
    public function setEmail($email) 
    {
        $this->email = $email;        
    }
    
    public function setPassword($password) 
    {
        $this->password = (string)$password;        
    }
    
    public function authenticate()
    {                
        // Check the database if there is a user with such email.
        // $user = $this->entityManager->getRepository(User::class)->findOneByEmail($this->email);

        $user = $this->database->query('SELECT * FROM utenti WHERE email = ?', [$this->email])->current();
                
        // If there is no such user, return 'Identity Not Found' status.
        if ($user == null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND, 
                null, 
                ['Invalid credentials.']);        
        }   
        
        // Now we need to calculate hash based on user-entered password and compare
        // it with the password hash stored in database.
        $bcrypt = new Bcrypt();
        $passwordHash = $user->password;
        
        if ($bcrypt->verify($this->password, $passwordHash)) {
            // Great! The password hash matches. Return user identity (email) to be
            // saved in session for later use.
            return new Result(
                    Result::SUCCESS, 
                    $this->email, 
                    ['Authenticated successfully.']);        
        }             
        
        // If password check didn't pass return 'Invalid Credential' failure status.
        return new Result(
                Result::FAILURE_CREDENTIAL_INVALID, 
                null, 
                ['Invalid credentials.']);        
    }
}


