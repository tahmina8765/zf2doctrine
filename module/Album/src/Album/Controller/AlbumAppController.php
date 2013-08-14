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
protected $fbprofilesTable;
protected $profilesTable;
protected $resourcesTable;
protected $role_resourcesTable;
protected $rolesTable;
protected $user_rolesTable;
protected $usersTable;


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

    protected function getFbprofilesTable()
    {
        if (!$this->fbprofilesTable) {
            $sm               = $this->getServiceLocator();
            $this->fbprofilesTable = $sm->get('Album\Table\FbprofilesTable');
        }
        return $this->fbprofilesTable;
    }

    protected function getProfilesTable()
    {
        if (!$this->profilesTable) {
            $sm               = $this->getServiceLocator();
            $this->profilesTable = $sm->get('Album\Table\ProfilesTable');
        }
        return $this->profilesTable;
    }

    protected function getResourcesTable()
    {
        if (!$this->resourcesTable) {
            $sm               = $this->getServiceLocator();
            $this->resourcesTable = $sm->get('Album\Table\ResourcesTable');
        }
        return $this->resourcesTable;
    }

    protected function getRoleResourcesTable()
    {
        if (!$this->role_resourcesTable) {
            $sm               = $this->getServiceLocator();
            $this->role_resourcesTable = $sm->get('Album\Table\RoleResourcesTable');
        }
        return $this->role_resourcesTable;
    }

    protected function getRolesTable()
    {
        if (!$this->rolesTable) {
            $sm               = $this->getServiceLocator();
            $this->rolesTable = $sm->get('Album\Table\RolesTable');
        }
        return $this->rolesTable;
    }

    protected function getUserRolesTable()
    {
        if (!$this->user_rolesTable) {
            $sm               = $this->getServiceLocator();
            $this->user_rolesTable = $sm->get('Album\Table\UserRolesTable');
        }
        return $this->user_rolesTable;
    }

    protected function getUsersTable()
    {
        if (!$this->usersTable) {
            $sm               = $this->getServiceLocator();
            $this->usersTable = $sm->get('Album\Table\UsersTable');
        }
        return $this->usersTable;
    }




}
