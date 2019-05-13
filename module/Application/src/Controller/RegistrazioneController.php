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

                // If we completed all 3 steps, redirect to Review page.

                // return $this->redirect()->toRoute(
                //     'registration',
                //     ['action' => 'review']
                // );

                // Go to the next step.
                return $this->redirect()->toRoute('registration');
            }
        }

        $viewModel = new ViewModel([
            'form' => $form
        ]);


        // $validator = new \Zend\Validator\Db\NoRecordExists(
        //     array(
        //         'table' => 'users',
        //         'field' => 'username',
        //         'exclude' => array(
        //             'field' => 'id',
        //             'value' => $user_id
        //         )
        //     )
        // );
        return $viewModel;
    }
}
