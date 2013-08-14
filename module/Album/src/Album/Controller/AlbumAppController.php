<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;

class AlbumAppController extends AbstractActionController
{

    protected $albumTable;

    public function __construct()
    {
//        parent::__construct();
    }

    protected function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm               = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Table\AlbumTable');
        }
        return $this->albumTable;
    }

}
