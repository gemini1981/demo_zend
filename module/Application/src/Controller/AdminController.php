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

    protected $authService;

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
        $id = $this->params()->fromRoute('id');

        echo $id;
    }

    public function dettaglioAction()
    {
        $id = $this->params()->fromRoute('id');
        $polizza = $this->PolizzeTable->findById($id);
        $polizza_extra = [];
        if ($polizza) {
            $polizza = $polizza->extract();
            switch ($polizza['tipo']) {
                case 'casa':
                    $polizza_extra = $this->PolizzeCasaTable->findByIdPolizza($id)->extract();
                    break;
                case 'auto':
                    $polizza_extra = $this->PolizzeAutoTable->findByIdPolizza($id)->extract();
                    break;
            }
        }

        $viewModel = new ViewModel([
            'polizza' => $polizza,
            'polizza_extra' => $polizza_extra,
        ]);
        return $viewModel;
    }
}
