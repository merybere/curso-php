<?php
class Application_Model_DbTable_Languages extends Zend_Db_Table_Abstract
{
	protected $_name = 'languages';
	
	public function getLanguage($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idlanguage = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}
	public function addLanguage($language)
	{
		$data = array(
				'language' => $language
		);
		$this->insert($data);
	}
	public function updateLanguage($id, $language)
	{
		$data = array(
				'language' => $language
		);
		$this->update($data, 'idlanguage = '. (int)$id);
	}
	public function deleteLanguaget($id)
	{
		$this->delete('idlanguage =' . (int)$id);
	}
}