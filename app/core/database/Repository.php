<?php
abstract class Repository implements IRepository {

	protected $Database;
	protected $tableName;

	/* constructor */
	function __construct($tableName) {
		$this->Database = Database::getInstance();
		$this->tableName = $tableName;
	}

	/*
	 * Creates a new data record.
	 *
	 * @param data Data to add.
	 */
	public function create($data) {
		$this->Database->insert($this->tableName, $data);
	}

	/*
	 * Duplicates a specific data record.
	 *
	 * @param id Identifier of the record to duplicate.
	 */
	public function duplicate($id) {
		$data = $this->get($id);
		unset($data['id']);
		$this->create($data);
	}

	/*
	 * Updates a existing data record.
	 *
	 * @param id Identifier of the record to duplicate.
	 * @param data Data to update.
	 */
	public function update($id, $data) {
		$this->Database->update($this->tableName, $data, $id);
	}

	/*
	 * Deletes a specific data record.
	 *
	 * @param id Identifier of the record to delete.
	 */
	public function delete($id) {
		$this->Database->delete($this->tableName, $id);
	}

	/*
	 * Gets a specific data record.
	 *
	 * @param id Identifier of the record to get.
	 * @return object Anonymous object representing the data record.
	 */
	public function get($id) {
		return $this->Database->select("SELECT * FROM $this->tableName WHERE id = :id", array('id' => $id))[0];
	}

	/*
	 * Gets all data records.
	 *
	 * @return object Anonymous object representing all data records.
	 */
	public function getAll() {
		return $this->Database->select("SELECT * FROM $this->tableName");
	}
}
?>
