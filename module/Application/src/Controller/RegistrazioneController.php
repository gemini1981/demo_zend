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

    const REG_SUCCESS   = '<b style="color:green;">Registration was successful</b>';
    const REG_FAIL      = '<b style="color:red;">Registration failed</b>';

    public function indexAction()
    {
        $form = new RegistrazioneForm($this->database);

        if ($this->getRequest()->isPost()) {

            // preleva i dati dal POST
            $data = $this->params()->fromPost();

            // $form->bind(new Utente($data));
            $form->setData($data);

            // Valida i dati
            if ($form->isValid()) {

                // Ritorna i dat validati
                $data = $form->getData();
                $user= new Utente($data);

                if ($this->table->save($user)) {
                    $message = self::REG_SUCCESS;
                } else {
                    $message = self::REG_FAIL . '<br>' . implode('<br>', $this->database->getMessages());
                }

                // return $this->redirect()->toRoute('login');
            }
        }

        // $result = $this->database->query('SELECT * FROM `utenti`', Adapter::QUERY_MODE_EXECUTE);
        // print_r($result->current()->email);
        // echo $result->count();

        $viewModel = new ViewModel([
            'form'      => $form,
            'message'   => $message,
        ]);
        return $viewModel;
    }
}
