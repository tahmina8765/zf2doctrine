<?php
namespace Zf2auth\Table;

use Zend\Db\TableGateway\TableGateway;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zf2auth\Entity\Users;

class UsersTable extends AbstractTableGateway
{
    protected $table = 'users';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Users());

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


    public function getUsers($id) {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUsers(Users $users)
    {
        $data = array(
            'username' => $users->username,
		'email' => $users->email,
		'password' => $users->password,
		'email_check_code' => $users->email_check_code,
		'is_disabled' => $users->is_disabled,
		'created' => $users->created,
		'modified' => $users->modified,
		
        );

        $id = (int)$users->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getUsers($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteUsers($id)
    {
        $this->delete(array('id' => $id));
    }
}
            