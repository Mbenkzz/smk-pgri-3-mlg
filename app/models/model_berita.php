<?php

/**
 * 
 */
class Model_Berita extends Model {
	
	private $table = "berita";
	private $pk = "berita_id";
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

	function getJudul($string) {
		try {
			$string = strtolower($string);
			$stmt = $this->db->prepare("SELECT * FROM $this->table WHERE LOWER(berita_title) = '$string'");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetch();
	}

	function getFilteredData($search = "") {
		$where = "";
		if (!empty($search)) {
			$where .= "berita_title LIKE '%$search%' OR berita_description LIKE '%$search%' ";
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

	function getHashtag($id) {
		try {
			$stmt = $this->db->prepare("SELECT * FROM berita_hashtag WHERE $this->pk = $id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		$tags = [];
		foreach ($stmt->fetchAll() as $key => $value) {
			$tags[$key] = $value->hashtag_name;
		}
		return $tags;
	}

	function getSelectHashtag($search, $mboh) {
		$search = strtolower($search);

		$where = "";
		if(!empty($search))
			$where .= "LOWER(hashtag) LIKE '%$search%'";

		if(!empty($mboh)) 
			$where .= empty($where) ? "hashtag NOT IN ($mboh)" : "AND hashtag NOT IN ($mboh)";

		if(!empty($where))
			$where = "WHERE ". $where;

		$query = "SELECT * FROM hashtag $where LIMIT 5";
		// die($query);
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			die($e->getMessage());
		}
		$tags = [];
		foreach ($stmt->fetchAll() as $key => $value) {
			$tags[$key] = $value->hashtag;
		}
		return $tags;
	}

	function getTable($search = "", $perPage = 5, $currentPage = 1, $order = "") {
		$offset = ($currentPage - 1) * $perPage;

		$where = "";
		if (!empty($search)) {
			$where .= "berita_title LIKE '%$search%' OR berita_description LIKE '%$search%' ";
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
			$query = "INSERT INTO $this->table (berita_title, berita_description, file_directory, created_at, updated_at, created_by, updated_by,  isactive) VALUES ('$data->title', '$data->description', '$data->directory', '$this->date', '$this->date', $data->acted_by, $data->acted_by, $data->isactive)";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			echo $query;	
			die($e->getMessage());
		}
		return $this->db->lastInsertId();
	}

	function updateData($data, $id) {
		try {
			$file = !empty($data->directory) ? "file_directory='$data->directory'," : "";
			$query = "UPDATE $this->table SET berita_title='$data->title', berita_description='$data->description', $file isactive=$data->isactive, updated_by=$data->acted_by, updated_at='$this->date' WHERE $this->pk = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return false;
		}
		return $query;
	}

	function addHashtag($data, $id) {
		try {
			if($id) {
				$del_query = "DELETE FROM berita_hashtag WHERE berita_id = $id";
				$this->db->query($del_query);
			}
			foreach ($data->tags as $key => $value) {
				$tag_name = strtolower($value);
				$query = "
						INSERT INTO hashtag (hashtag)
							SELECT * FROM (SELECT '$tag_name') AS tmp
							WHERE NOT EXISTS (
    						SELECT hashtag FROM hashtag WHERE hashtag = '$tag_name'
						) LIMIT 1;
						INSERT INTO berita_hashtag (berita_id, hashtag_name) VALUES ($id, '$tag_name')";
						$this->db->query($query);

			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
		
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

	function toggleApprove($id) {
		try {
			$query = "UPDATE `$this->table` SET `isapprove` = 1, `isactive` = 1 WHERE `$this->table`.`$this->pk` = $id";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
		} catch (Exception $e) {
			return FALSE;
		}
		return $query;
	}

	function getPreviewBerita($id) {
		try {
			$stmt = $this->db->prepare("SELECT *, berita_id as id, berita_title as title, berita_description as description FROM $this->table WHERE $this->pk = $id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetch();
	}
}