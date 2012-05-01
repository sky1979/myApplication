<?php
namespace User\Model;
use Zend\Db\TableGateway\TableGateway,
	Zend\Db\Adapter\Adapter,
	Zend\Db\ResultSet\ResultSet;
class UserTable extends TableGateway
{
	public function __construct(Adapter $adapter = null, $databaseSchema = null,
		ResultSet $selectResultPrototype = null)
	{
		return parent::__construct('uplinkuser', $adapter, $databaseSchema,
		$selectResultPrototype);
	}
	public function fetchAll()
	{
		$resultSet = $this->select();
		return $resultSet;
	}
	public function getUser($id)
	{
		$id = (int) $id;
		$rowset = $this->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	public function addUser($first_name, $last_name, $password)
	{
		$data = array(
		'first_name' => $first_name,
		'last_name' => $last_name,
		'password' => $password,
		'rightsId' => 2, 
		);
		$this->insert($data);
	}
	public function updateUser($id, $first_name, $last_name, $password)
	{
		$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'password' => $password,
			'rightsId' => 7,
		);
		$this->update($data, array('id' => $id));
	}
	public function deleteUser($id)
	{
		$this->delete(array('id' => $id));
	}
}