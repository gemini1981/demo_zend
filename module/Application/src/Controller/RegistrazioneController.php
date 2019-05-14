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

class RegistrazioneController extends AbstractActionController
{

    private $db;

    public function __construct($container)
    {
        $this->db = $container->get(\Zend\Db\Adapter\Adapter::class);
    }

    public function indexAction()
    {
        $form = new RegistrazioneForm($this->db);

        if ($this->getRequest()->isPost()) {

            // preleva i dati dal POST
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Valida i dati
            if ($form->isValid()) {

                // Ritorna i dat validati
                $data = $form->getData();

                return $this->redirect()->toRoute('registrazione');
            }
        }

        $viewModel = new ViewModel([
            'form' => $form
        ]);

        $result = $this->db->query('SELECT * FROM `utenti`', Adapter::QUERY_MODE_EXECUTE);
        echo $result->count();
        return $viewModel;
    }
}
