<?php

/**
 * 
 */
class Model_Users extends Model {
	
	private $table = "users";
	private $pk = "user_id";
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
			$stmt = $this->db->prepare("SELECT user_id, username, created_at, updated_at, isactive FROM $this->table");
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
			$where .= "username LIKE '%$search%' ";
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
			$stmt = $this->db->prepare("SELECT user_id, username, created_at, updated_at, isactive, fullname, role FROM $this->table WHERE $this->pk = $id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetch();
	}

	function getUsername($username) {
		try {
			$stmt = $this->db->prepare("SELECT * FROM $this->table WHERE username = '$username'");
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
			$where .= "username LIKE '%$search%' ";
		}

		if(!empty($where)) {
			$where = "WHERE " . $where;
		}
		try {
			$query_string = "SELECT user_id, username, created_at, updated_at, isactive, role FROM $this->table $where ORDER BY $order LIMIT $perPage OFFSET $offset";
			$stmt = $this->db->prepare($query_string);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function insertData($data) {
		try {
			$query = "INSERT INTO $this->table (username, pswd, created_at, fullname, role, isactive) VALUES ('$data->username', '$data->pswd', '$this->date', '$data->fullname', '$data->role', $data->isactive)";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}

	function updateData($data, $id) {
		try {
			$pswd = !empty($data->pswd) ? ",pswd='$data->pswd'" : "";
			$query = "UPDATE $this->table SET username='$data->username'$pswd,isactive=$data->isactive,fullname='$data->fullname',role='$data->role' WHERE $this->pk = $id";
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
			$query = "UPDATE `users` SET `isactive` = '$boolean' WHERE `users`.`user_id` = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}
}