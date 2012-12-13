<?php
class Application_Model_DbTable_Pets extends Zend_Db_Table_Abstract
{
	protected $_name = 'pets';
	
	public function getPet($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idpet = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	public function addPet($pet)
	{
		$data = array(
				'pet' => $pet
		);
		$this->insert($data);
	}
	public function updatePet($id, $pet)
	{
		$data = array(
				'pet' => $pet
		);
		$this->update($data, 'idpet = '. (int)$id);
	}
	public function deletePet($id)
	{
		$this->delete('idpet =' . (int)$id);
	}
}