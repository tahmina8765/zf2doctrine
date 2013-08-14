<?php
namespace Zf2auth\Table;

use Zend\Db\TableGateway\TableGateway;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zf2auth\Entity\Fbprofiles;

class FbprofilesTable extends AbstractTableGateway
{
    protected $table = 'fbprofiles';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Fbprofiles());

        $this->initialize();
    }

    public function fetchAll(Select $select = null) {
        if (null === $select)
            $select = new Select();
        $select->from($this->table);
        $resultSet = $this->selectWith($select);
        $resultSet->buffer();
        return $resultSet;
    }


    public function getFbprofiles($id) {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveFbprofiles(Fbprofiles $fbprofiles)
    {
        $data = array(
            'user_id' => $fbprofiles->user_id,
		'facebook_id' => $fbprofiles->facebook_id,
		'name' => $fbprofiles->name,
		'first_name' => $fbprofiles->first_name,
		'last_name' => $fbprofiles->last_name,
		'link' => $fbprofiles->link,
		'username' => $fbprofiles->username,
		'email' => $fbprofiles->email,
		'gender' => $fbprofiles->gender,
		'timezone' => $fbprofiles->timezone,
		'locale' => $fbprofiles->locale,
		'verified' => $fbprofiles->verified,
		'updated_time' => $fbprofiles->updated_time,
		
        );

        $id = (int)$fbprofiles->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getFbprofiles($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteFbprofiles($id)
    {
        $this->delete(array('id' => $id));
    }
}
            