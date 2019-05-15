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
use Zend\Db\Adapter\Adapter;
use Application\Model\Utente;

class RegistrazioneController extends AbstractActionController
{
    use \Application\Traits\DatabaseTrait;
    use \Application\Traits\UtentiTableTrait;

    public function indexAction()
    {
        $form = new RegistrazioneForm($this->database);

        if ($this->getRequest()->isPost()) {

            // preleva i dati dal POST
            $data = $this->params()->fromPost();

            // $form->bind(new Utente());

            $form->setData($data);

            // Valida i dati
            if ($form->isValid()) {

                // Ritorna i dat validati
                $data = $form->getData();

                print_r($data);

                //    if ($this->table->save($user)) {
                //         $message = self::REG_SUCCESS;
                //     } else {
                //         $message = self::REG_FAIL . '<br>' . implode('<br>', $result->getMessages());
                //     }

                return $this->redirect()->toRoute('registrazione');
            }
        }

        $viewModel = new ViewModel([
            'form' => $form
        ]);

        $result = $this->database->query('SELECT * FROM `utenti`', Adapter::QUERY_MODE_EXECUTE);
        print_r($result->current()->email);

        echo $result->count();
        return $viewModel;
    }
}
