<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\RegistrazioneForm;
use Zend\Session\Container;

class RegistrazioneController extends AbstractActionController
{


    public function indexAction()
    {
        $form = new RegistrazioneForm();

        if ($this->getRequest()->isPost()) {

            // preleva i dati dal POST
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Valida i dati
            if ($form->isValid()) {

                // Ritorna i dat validati
                $data = $form->getData();

                return $this->redirect()->toRoute('registration');
            }
        }

        $viewModel = new ViewModel([
            'form' => $form
        ]);

        return $viewModel;
    }
}
