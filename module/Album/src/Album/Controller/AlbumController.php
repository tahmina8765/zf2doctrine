<?php

namespace Album\Controller;

use Zend\View\Model\ViewModel;
use Album\Entity\Album;
use Album\Form\AlbumForm;
use Album\Form\AlbumSearchForm;
use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
use Doctrine\ORM\EntityManager;     // Add this line

class AlbumController extends AlbumAppController
{

    public $vm;

//    protected $albumTable;

    function __construct()
    {
        parent::__construct();
        $this->vm = new viewModel();
    }

//    public function getAlbumTable()
//    {
//        if (!$this->albumTable) {
//            $sm               = $this->getServiceLocator();
//            $this->albumTable = $sm->get('Album\Table\AlbumTable');
//        }
//        return $this->albumTable;
//    }

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function searchAction()
    {

        $request = $this->getRequest();

        $url = 'index';

        if ($request->isPost()) {
            $formdata    = (array) $request->getPost();
            $search_data = array();
            foreach ($formdata as $key => $value) {
                if ($key != 'submit') {
                    if (!empty($value)) {
                        $search_data[$key] = $value;
                    }
                }
            }
            if (!empty($search_data)) {
                $search_by = json_encode($search_data);
                $url .= '/search_by/' . $search_by;
            }
        }
        $this->redirect()->toUrl($url);
    }

    public function indexAction()
    {

        $searchform = new AlbumSearchForm();
        $searchform->get('submit')->setValue('Search');

        $select = new Select();

        $order_by  = $this->params()->fromRoute('order_by') ?
                $this->params()->fromRoute('order_by') : 'id';
        $order     = $this->params()->fromRoute('order') ?
                $this->params()->fromRoute('order') : Select::ORDER_ASCENDING;
        $page      = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        $select->order($order_by . ' ' . $order);
        $search_by = $this->params()->fromRoute('search_by') ?
                $this->params()->fromRoute('search_by') : '';


        $where    = new \Zend\Db\Sql\Where();
        $formdata = array();
        if (!empty($search_by)) {
            $formdata = (array) json_decode($search_by);
            if (!empty($formdata['artist'])) {
                $where->addPredicate(
                        new \Zend\Db\Sql\Predicate\Like('artist', '%' . $formdata['artist'] . '%')
                );
            }
            if (!empty($formdata['title'])) {
                $where->addPredicate(
                        new \Zend\Db\Sql\Predicate\Like('title', '%' . $formdata['title'] . '%')
                );
            }
        }
        if (!empty($where)) {
            $select->where($where);
        }

        $album = $this->getEntityManager()->getRepository('Album\Entity\Album')->findAll();


        $searchform->setData($formdata);


        $this->vm->setVariables(array(
            'search_by'   => $search_by,
            'order_by'    => $order_by,
            'order'       => $order,
            'page'        => $page,
            'paginator'   => $album,
            'pageAction'  => 'album',
            'form'        => $searchform,
            'totalRecord' => $totalRecord
        ));
        return $this->vm;
    }

    public function addAction()
    {

        $form = new AlbumForm();
        $form->get('submit')->setAttribute('label', 'Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getEntityManager()->persist($album);
                $this->getEntityManager()->flush();
                return $this->redirect()->toRoute('album');
            }

//            if ($form->isValid()) {
//                $album->exchangeArray($form->getData());
//                $confirm = $this->getAlbumTable()->saveAlbum($album);
//
//                // Redirect to list of albums
//                return $this->redirect()->toRoute('album');
//            }
        }
        $this->vm->setVariables(array(
            'flashMessages' => $this->flashMessenger()->getMessages(),
            'form'          => $form
        ));

        return $this->vm;
    }

    // Add content to this method:
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                        'action' => 'add'
            ));
        }
        $album = $this->getAlbumTable()->getAlbum($id);

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $confirm = $this->getAlbumTable()->saveAlbum($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        $this->vm->setVariables(array(
            'flashMessages' => $this->flashMessenger()->getMessages(),
            'id'            => $id,
            'form'          => $form,
        ));

        return $this->vm;
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {

            $id      = (int) $request->getPost('id');
            $confirm = $this->getAlbumTable()->deleteAlbum($id);


            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }
        $this->vm->setVariables(array(
            'flashMessages' => $this->flashMessenger()->getMessages(),
            'id'            => $id,
            'album'         => $this->getAlbumTable()->getAlbum($id)
        ));

        return $this->vm;
    }

}
