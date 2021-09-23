<?php

/**
 * 
 */
class Model_Sosmed extends Model {
	
	private $table = "sosmed";
	private $pk = "sosmed_id";
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
			$stmt = $this->db->prepare("SELECT * FROM $this->table");
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
			$where .= "sosmed_platform LIKE '%$search%' OR sosmed_akunid LIKE '%$search%'";
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
			$where .= "sosmed_platform LIKE '%$search%' OR sosmed_akunid LIKE '%$search%' ";
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
			$query = "INSERT INTO $this->table (sosmed_platform, sosmed_akunid, sosmed_akuntautan, created_at, updated_at, created_by, updated_by,  isactive) VALUES ('$data->platform', '$data->akun', '$data->tautan', '$this->date', '$this->date', $data->acted_by, $data->acted_by, $data->isactive)";
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
			$query = "UPDATE $this->table SET sosmed_akunid='$data->akun', sosmed_akuntautan='$data->tautan', isactive=$data->isactive, updated_by=$data->acted_by, updated_at='$this->date' WHERE $this->pk = $id";
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
			$query = "UPDATE `sosmed` SET `isactive` = '$boolean' WHERE `sosmed`.`$this->pk` = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}
}