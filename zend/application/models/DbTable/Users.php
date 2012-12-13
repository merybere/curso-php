<?php
class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';
	
	public function getUser($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('iduser = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	public function addUser($name, $email, $password, $description,
        		        	$photo, $coders, $cities_idcity)
	{
		$data = array(
				'name' => $name,
		        'email' => $email,
		        'password' => $password,
		        'description' => $description,
		        'photo' => $photo,
		        'coders' => $coders,
		        'cities_idcity' => $cities_idcity,
		        'roles_idrol' => 1
		);
		$this->insert($data);
	}
	public function updateUser($id, $name, $email, $password, $description,
        		        	$photo, $coders, $cities_idcity)
	{
		$data = array(
				'name' => $name,
		        'email' => $email,
		        'password' => $password,
		        'description' => $description,
		        'photo' => $photo,
		        'coders' => $coders,
		        'cities_idcity' => $cities_idcity
		);
		$this->update($data, 'iduser = '. (int)$id);
	}
	public function deleteUser($id)
	{
		$this->delete('iduser =' . (int)$id);
	}
}