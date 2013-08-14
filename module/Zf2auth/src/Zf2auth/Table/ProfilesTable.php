<?php
namespace Zf2auth\Table;

use Zend\Db\TableGateway\TableGateway;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zf2auth\Entity\Profiles;

class ProfilesTable extends AbstractTableGateway
{
    protected $table = 'profiles';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Profiles());

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


    public function getProfiles($id) {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveProfiles(Profiles $profiles)
    {
        $data = array(
            'user_id' => $profiles->user_id,
		'first_name' => $profiles->first_name,
		'last_name' => $profiles->last_name,
		'created' => $profiles->created,
		'modified' => $profiles->modified,
		
        );

        $id = (int)$profiles->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getProfiles($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteProfiles($id)
    {
        $this->delete(array('id' => $id));
    }
}
            