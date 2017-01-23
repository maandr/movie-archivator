<?php
interface IRepository {
	function create($data);
	function update($id, $data);
	function delete($id);
	function get($id);
}
?>
