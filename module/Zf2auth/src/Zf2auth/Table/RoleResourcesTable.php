<?php
namespace Zf2auth\Table;

use Zend\Db\TableGateway\TableGateway;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zf2auth\Entity\RoleResources;

class RoleResourcesTable extends AbstractTableGateway
{
    protected $table = 'role_resources';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new RoleResources());

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


    public function getRoleResources($id) {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveRoleResources(RoleResources $role_resources)
    {
        $data = array(
            'role_id' => $role_resources->role_id,
		'resource_id' => $role_resources->resource_id,
		
        );

        $id = (int)$role_resources->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getRoleResources($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteRoleResources($id)
    {
        $this->delete(array('id' => $id));
    }
}
            