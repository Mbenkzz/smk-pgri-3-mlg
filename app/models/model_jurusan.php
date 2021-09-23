<?php

/**
 * 
 */
class Model_Jurusan extends Model {
	
	private $table = "jurusan";
	private $pk = "jurusan_id";
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
			$stmt = $this->db->prepare("SELECT j.*, d.departement_name, d.departement_id FROM $this->table as j INNER JOIN departement as d ON j.departement_id = d.departement_id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getFilteredData($search = "") {
		$where = "";
		if (!empty($search)) {
			$where .= "jurusan_name LIKE '%$search%' ";
		}

		if(!empty($where)) {
			$where = "WHERE " . $where;
		}

		try {
			$stmt = $this->db->prepare("SELECT j.*, d.departement_name, d.departement_id FROM $this->table as j INNER JOIN departement as d ON j.departement_id = d.departement_id $where");
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
			$stmt = $this->db->prepare("SELECT j.*, d.departement_name, d.departement_id FROM $this->table as j INNER JOIN departement as d ON j.departement_id = d.departement_id WHERE $this->pk = $id");
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
			$where .= "j.jurusan_name LIKE '%$search%' OR d.departement_name LIKE '%$search%'";
		}

		if(!empty($where)) {
			$where = "WHERE " . $where;
		}
		try {
			$query_string = "SELECT j.*, d.departement_name, d.departement_id FROM $this->table as j INNER JOIN departement as d ON j.departement_id = d.departement_id $where ORDER BY $order LIMIT $perPage OFFSET $offset";
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
			$query = "INSERT INTO $this->table (departement_id, jurusan_name, jurusan_description, file_directory, created_at, updated_at, created_by, updated_by,  isactive) VALUES ('$data->departmentid', '$data->jurusanname', '$data->description', '$data->directory', '$this->date', '$this->date', $data->acted_by, $data->acted_by, $data->isactive)";
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
			$query = "UPDATE $this->table SET departement_id='$data->departmentid', jurusan_name='$data->jurusanname', jurusan_description='$data->description', $file isactive=$data->isactive, updated_by=$data->acted_by, updated_at='$this->date' WHERE $this->pk = $id";
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
			$query = "UPDATE `$this->table` SET `isactive` = '$boolean' WHERE `$this->table`.`$this->pk` = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}
}