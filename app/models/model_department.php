<?php

/**
 * 
 */
class Model_Department extends Model {
	
	private $table = "departement";
	private $pk = "departement_id";
	private $date;

	function __construct() {
		parent::__construct();
		$this->date = getCurrentDate();
	}

	function exampleMethod () {
        //$stmt = $this->db->prepare();
		return true;
	}

	function getAllData() {
		try {
			$stmt = $this->db->prepare("SELECT departement_id, departement_name, departement_description, file_directory, updated_at, isactive FROM $this->table");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getFilteredData($search = "") {
		$where = "";
		if (!empty($search)) {
			$where .= "departement_name LIKE '%$search%' ";
		}

		if(!empty($where)) {
			$where = "WHERE " . $where;
		}

		try {
			$stmt = $this->db->prepare("SELECT * FROM $this->table $where");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getSingleData($id) {
		try {
			$stmt = $this->db->prepare("SELECT * FROM $this->table WHERE $this->pk = $id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetch();
	}

	function getTable($search = "", $perPage = 5, $currentPage = 1, $order = "") {
		$offset = ($currentPage - 1) * $perPage;

		$where = "";
		if (!empty($search)) {
			$where .= "departement_name LIKE '%$search%' ";
		}

		if(!empty($where)) {
			$where = "WHERE " . $where;
		}
		try {
			$query_string = "SELECT * FROM $this->table $where ORDER BY $order LIMIT $perPage OFFSET $offset";
			$stmt = $this->db->prepare($query_string);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			die(json_response("GAGAL", $e->getMessage()));
		}
		return $stmt->fetchAll();
	}

	function insertData($data) {
		try {
			$query = "INSERT INTO $this->table (departement_name, departement_description, file_directory, created_at, updated_at, created_by, updated_by,  isactive) VALUES ('$data->departmentname', '$data->description', '$data->directory', '$this->date', '$this->date', $data->acted_by, $data->acted_by, $data->isactive)";
			// die($query);
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}

	function updateData($data, $id) {
		try {
			$file = !empty($data->directory) ? "file_directory='$data->directory'," : "";
			$query = "UPDATE $this->table SET departement_name='$data->departmentname', departement_description='$data->description', $file isactive=$data->isactive, updated_by=$data->acted_by, updated_at='$this->date' WHERE $this->pk = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}

	function deleteData($id) {
		try {
			$query = "DELETE FROM $this->table WHERE $this->pk = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}

	function toggleActive($boolean, $id) {
		try {
			$query = "UPDATE `departement` SET `isactive` = '$boolean' WHERE `departement`.`departement_id` = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}
}