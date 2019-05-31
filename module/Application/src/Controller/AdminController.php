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

class AdminController extends AbstractActionController
{
    use \Application\Traits\UtentiTableTrait;
    use \Application\Traits\PolizzeTableTrait;

    const REG_SUCCESS = '<b style="color:green;">Registration was successful</b>';
    const REG_FAIL = '<b style="color:red;">Registration failed</b>';

    protected $authService;

    protected $formPolizza;

    public function setFormPolizza(PolizzaForm $form)
    {
        $this->formPolizza = $form;
    }

    public function setAuthService($authService)
    {
        $this->authService = $authService;
    }

    public function indexAction()
    {
        $identity = $this->authService->getIdentity();
        $utente = $this->UtentiTable->findByEmail($identity);

        $viewModel = new ViewModel([
            'hasIdentity' => $this->authService->hasIdentity(),
            'utente' => $utente->getNome() . ' ' . $utente->getCognome(),
        ]);
        $viewModel->setTemplate('application/index/index');
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

    public function modificaAction()
    {
        // $message = '';

        $id = $this->params()->fromRoute('id');

        $polizza = $this->PolizzeTable->findById($id);

        $polizza_extra = ($this->PolizzeExtraTable[$polizza->getTipo()])
            ->findByIdPolizza($polizza->getId());

        $this->formPolizza->addElementExtra($this->formPolizza->getExtraFieldsetsByField($polizza->getTipo()));

        if ($this->getRequest()->isPost()) {

            // preleva i dati dal POST
            $data = $this->params()->fromPost();

            $this->formPolizza->setData($data);

            // Valida i dati
            if ($this->formPolizza->isValid()) {

                // Ritorna i dat validati
                $data = array_merge($polizza->extract(), $this->formPolizza->getData());
                $polizza = new Polizza($data);

                if ($this->PolizzeTable->save($polizza)) {
                    $message = self::REG_SUCCESS;
                } else {
                    // $message = self::REG_FAIL . '<br>' . implode('<br>', $this->database->getMessages());
                }
            }
        } else {
            $data = $polizza->extract();
            $data['polizza_extra'] = $polizza_extra->extract();
            $this->formPolizza->setData($data);
        }

        $viewModel = new ViewModel([
            'form' => $this->formPolizza,
        ]);
        return $viewModel;
    }

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

    public function nuovaAction()
    {

        echo 'nuova';
        $viewModel = new ViewModel([]);

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
            $polizza_extra = ($this->PolizzeExtraTable[$tipo])
                ->findByIdPolizza($id)->extract();
        }

        $viewModel = new ViewModel([
            'polizza' => $polizza,
            'polizza_extra' => $polizza_extra,
        ]);
        return $viewModel;
    }
}
