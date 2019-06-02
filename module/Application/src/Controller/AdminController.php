<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\PolizzaForm;
use Application\Model\Polizza;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\SelezionaTipoForm;

class AdminController extends AbstractActionController
{
    use \Application\Traits\UtentiTableTrait;
    use \Application\Traits\PolizzeTableTrait;
    use \Application\Traits\PolizzeExtraTrait;

    protected $authService;

    protected $formPolizza;
    protected $formSelezionaTipo;

    public function setFormPolizza(PolizzaForm $form)
    {
        $this->formPolizza = $form;
    }

    public function setFormSelezionaTipo(SelezionaTipoForm $form)
    {
        $this->formSelezionaTipo = $form;
    }

    public function setAuthService($authService)
    {
        $this->authService = $authService;
    }

    protected function _getUtente()
    {
        $identity = $this->authService->getIdentity();
        $utente = $this->UtentiTable->findByEmail($identity);
        return $utente;
    }

    public function indexAction()
    {
        $utente = $this->_getUtente();

        $viewModel = new ViewModel([
            'hasIdentity' => $this->authService->hasIdentity(),
            'utente' => $utente->getNome() . ' ' . $utente->getCognome(),
        ]);
        $viewModel->setTemplate('application/index/index');
        return $viewModel;
    }

    public function profiloAction()
    {
        $utente = $this->_getUtente();

        $viewModel = new ViewModel([
            'utente' => $utente,
        ]);
        return $viewModel;
    }

    protected function _polizza($id = null, $tipo = null)
    {
        if ($id) {
            $polizza = $this->PolizzeTable->findById($id);
            $tipo = $polizza->getTipo();
            $polizza_extra = ($this->PolizzeExtraTable[$tipo])->findByIdPolizza($polizza->getId());
        } else {
            $polizza = new Polizza();
            $polizza->setIdUtente($this->_getUtente()->getId());
            $polizza->setTipo($tipo);
            $polizza_extra = new $this->PolizzeExtra[$tipo];
        }

        $this->formPolizza->addElementExtra($this->formPolizza->getExtraFieldsetsByField($tipo));

        if ($this->getRequest()->getPost('step') == 2 && $this->getRequest()->isPost()) {

            // preleva i dati dal POST
            $form_data = $this->params()->fromPost();
            $this->formPolizza->setData($form_data);

            // Valida i dati
            if ($this->formPolizza->isValid()) {
                $polizza->hydrate($form_data);
                $this->PolizzeTable->save($polizza);
                $idpolizza = $polizza->getId() ?: $this->PolizzeTable->getLastId();
                $form_data['polizza_extra']['idpolizza'] = $idpolizza;
                $polizza_extra->hydrate($form_data['polizza_extra']);
                ($this->PolizzeExtraTable[$tipo])->save($polizza_extra);
                return true;
            }
        } elseif ($tipo && $this->getRequest()->getPost('step') == 2) {
            $this->formPolizza->setData(['tipo' => $tipo]);
        } else {
            $data = $polizza->extract();
            $data['polizza_extra'] = $polizza_extra->extract();
            $this->formPolizza->setData($data);
        }
        return false;
    }

    public function tipoAction()
    {
        $viewModel = new ViewModel([
            'form' => $this->formSelezionaTipo,
        ]);
        return $viewModel;
    }

    public function modificaAction()
    {
        $id = $this->params()->fromRoute('id');
        if($this->_polizza($id, null)){
            return $this->redirect()->toRoute('admin', ['action' => 'elenco']);
        }

        $viewModel = new ViewModel([
            'form' => $this->formPolizza,
        ]);
        $viewModel->setTemplate('application/admin/polizza');
        return $viewModel;
    }

    public function nuovaAction()
    {
        $tipo = $this->getRequest()->getPost('tipo');
        if($this->_polizza(null, $tipo)){
            return $this->redirect()->toRoute('admin', ['action' => 'elenco']);
        }

        $viewModel = new ViewModel([
            'form' => $this->formPolizza,
        ]);
        $viewModel->setTemplate('application/admin/polizza');
        return $viewModel;
    }


    public function elencoAction()
    {
        $idutente = $this->_getUtente()->getId();
        $polizze = $this->PolizzeTable->findByIdUtente($idutente);
        $viewModel = new ViewModel([
            'polizze' => $polizze,
        ]);
        return $viewModel;
    }

    public function dettaglioAction()
    {
        $id = $this->params()->fromRoute('id');
        $polizza = $this->PolizzeTable->findById($id);
        $polizza_extra = [];
        if ($polizza) {
            $polizza = $polizza->extract();
            $tipo = $polizza['tipo'];
            $polizza_extra = ($this->PolizzeExtraTable[$tipo])->findByIdPolizza($id)->extract();
        }

        $viewModel = new ViewModel([
            'polizza' => $polizza,
            'polizza_extra' => $polizza_extra,
        ]);
        return $viewModel;
    }
}
