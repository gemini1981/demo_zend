<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\LoginForm;
use Zend\Authentication\Result;

class LoginController extends AbstractActionController
{
    protected $formLogin;
    protected $authManager;

    public function setAuthManager($authManager)
    {
        $this->authManager = $authManager;
    }

    public function setFormLogin(LoginForm $form)
    {
        $this->formLogin = $form;
    }

    public function loginAction()
    {

        $message = '';

        if ($this->getRequest()->isPost()) {

            $data = $this->params()->fromPost();

            $this->formLogin->setData($data);

            // valida i dati
            if ($this->formLogin->isValid()) {

                // preleva i dati validati
                $data = $this->formLogin->getData();

                // verifica le credenziali
                $result = $this->authManager->login(
                    $data['email'],
                    $data['password'],
                );

                // Check result.
                if ($result->getCode() == Result::SUCCESS) {
                    return $this->redirect()->toRoute('admin');
                }
            }
            $message = 'Error login';
        }

        return new ViewModel([
            'form' => $this->formLogin,
            'message' => $message,
        ]);
    }

    public function logoutAction()
    {
        $this->authManager->logout();

        return $this->redirect()->toRoute('home');
    }
}
