<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    use \Application\Traits\UtentiTableTrait;
    use \Application\Traits\PolizzeTableTrait;

    protected $t;

    protected $authService;

    // protected $formAdmin;

    // public function setFormAdmin(AdminForm $form)
    // {
    //     $this->formAdmin = $form;
    // }

    public function setAuthService($authService)
    {
        $this->authService = $authService;
    }

    public function indexAction()
    {
        $identity = $this->authService->getIdentity();
        $utente = $this->UtentiTable->findByEmail($identity);

        $viewModel = new ViewModel([
            'utente' => $utente->getNome() . ' ' . $utente->getCognome(),
        ]);
        return $viewModel;
    }

    public function profiloAction()
    {
        $identity = $this->authService->getIdentity();
        $utente = $this->UtentiTable->findByEmail($identity);

        $viewModel = new ViewModel([
            'utente' => $utente,
        ]);
        return $viewModel;
    }

    public function nuovaAction()
    { }

    public function elencoAction()
    {
        $identity = $this->authService->getIdentity();
        $utente = $this->UtentiTable->findByEmail($identity);
        $polizze = $this->PolizzeTable->findByIdUtente($utente->getId());
        $viewModel = new ViewModel([
            'polizze' => $polizze,
        ]);
        return $viewModel;
    }

    public function modificaAction()
    {
        $id_polizza = $this->params()->fromRoute('id');
        echo $id_polizza;
    }

    public function dettaglioAction($id_polizza)
    { }
}
