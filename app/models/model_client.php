<?php

class Model_Client extends Model {

	private $date;

	public function __construct() {
		parent::__construct();
		$this->date = getCurrentDate();
	}

	public function getAllDepartment(){
		try {
			$stmt = $this->db->prepare("SELECT * FROM departement");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return $e->getMessage();
		}
		return $stmt->fetchAll();
	}

	public function getJurusan($choose = "departement", $departement_id = NULL) {
		try {
			switch ($choose) {
				case 'departement':
					$query = "SELECT d.departement_name, d.departement_id FROM jurusan as j INNER JOIN departement as d ON j.departement_id = d.departement_id WHERE j.isactive = 1 GROUP BY d.departement_id";
					break;
				case 'jurusan':
					if(!$departement_id)
						die("Error terdeteksi, silahkan hubungi Developer kami");
					$query = "SELECT j.*, d.departement_name, d.departement_id FROM jurusan as j INNER JOIN departement as d ON j.departement_id = d.departement_id WHERE j.isactive = 1 AND d.departement_id = $departement_id";
					break;
				default:
					$query = "SELECT j.*, d.departement_name, d.departement_id FROM jurusan as j INNER JOIN departement as d ON j.departement_id = d.departement_id WHERE j.isactive = 1";
					break;
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return $e->getMessage();
		}
		return $stmt->fetchAll();
	}

	function getBerita($limit = FALSE) {
		try {
			if(!$limit)
				$limit_query = "";
			else
				$limit_query = "LIMIT $limit OFFSET 0";
			// $query = "SELECT * FROM $this->table WHERE isactive = 1 AND isapprove = 1 $limit_query";
			$query = "SELECT * FROM berita WHERE isapprove=1 ORDER BY created_at DESC $limit_query";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getBeritaRelated($limit = FALSE, $tag_list, $current_id) {
		try {
			if(!$limit)
				$limit_query = "";
			else
				$limit_query = "LIMIT $limit OFFSET 0";
			// $query = "SELECT * FROM $this->table WHERE isactive = 1 AND isapprove = 1 $limit_query";
			$query = "SELECT * FROM berita as b INNER JOIN berita_hashtag as bh ON b.berita_id = bh.berita_id WHERE b.isapprove=1 AND bh.hashtag_name IN ($tag_list) AND b.berita_id != $current_id GROUP BY bh.berita_id $limit_query";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getBeritaBanyak($page = 1, $order_by = "updated_at DESC", $tags="") {
		$perPage = 5;
		$offset = ($page - 1) * $perPage;
		$where_tag = "";
		if(!empty($tags))
			$where_tag = "AND bh.hashtag_name IN ($tags)";
		try {
			$query_string = "SELECT b.*, bh.*, b.berita_id as id, count(k.komentar_id) as jumlah_komentar FROM berita as b LEFT JOIN berita_hashtag as bh ON b.berita_id = bh.berita_id LEFT JOIN komentar as k ON k.berita_id = b.berita_id WHERE b.isapprove=1 $where_tag GROUP BY bh.berita_id ORDER BY $order_by LIMIT $perPage OFFSET $offset";
			// die($query_string);
			$stmt = $this->db->prepare($query_string);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			die($e->getMessage());
		}
		return $stmt->fetchAll();
	}

	function getTagBeritaBanyak($tag, $page = 1, $order_by = "updated_at DESC") {
		$perPage = 5;
		$offset = ($page - 1) * $perPage;
		$tag = strtolower($tag);
		try {
			$query_string = "SELECT * FROM berita as b INNER JOIN berita_hashtag as bh ON b.berita_id = bh.berita_id WHERE b.isapprove=1 AND LOWER(bh.hashtag_name) = '$tag' AND b.berita_id != $current_id GROUP BY bh.berita_id ORDER BY $order_by LIMIT $perPage OFFSET $offset";
			$stmt = $this->db->prepare($query_string);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			die(json_response("GAGAL", $e->getMessage()));
		}
		return $stmt->fetchAll();
	}

	function getBeritaSatu($id) {
		try {
			$stmt = $this->db->prepare("SELECT * FROM berita WHERE berita_id = $id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetch();
	}

	function getAgendaBanyak($page = 1) {
		$perPage = 5;
		$offset = ($page - 1) * $perPage;
		try {
			$query_string = "SELECT *,agenda_id as id FROM agenda WHERE isactive=1 ORDER BY updated_at DESC LIMIT $perPage OFFSET $offset";
			$stmt = $this->db->prepare($query_string);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			die(json_response("GAGAL", $e->getMessage()));
		}
		return $stmt->fetchAll();
	}

	function getAgendaSatu($id) {
		try {
			$stmt = $this->db->prepare("SELECT * FROM agenda WHERE agenda_id = $id");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetch();
	}

	function getSocial() {
		try {
			$stmt = $this->db->prepare("SELECT * FROM sosmed");
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getPartner($mode = "list") {
		try {
			if($mode == "logo") {
				$stmt = $this->db->prepare("SELECT * FROM partner WHERE isactive = 1 HAVING CHAR_LENGTH(file_directory) > 0");
			} else {
				$stmt = $this->db->prepare("SELECT * FROM partner WHERE isactive = 1");
			}
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			return FALSE;
		}
		return $stmt->fetchAll();
	}

	function getHashtag($id = NULL, $limit = FALSE) {
		try {
			$where = "";
			if($id)
				$where = "WHERE b.berita_id = $id";
			if(!empty($where))
				$where .= " AND b.isapprove = 1";
			else
				$where = "WHERE b.isapprove = 1";
			if($limit)
				$limit_query = "LIMIT $limit";
			else
				$limit_query = "";
			$query = "SELECT bh.hashtag_name, COUNT(bh.berita_id) as jumlah FROM berita_hashtag as bh INNER JOIN berita as b ON b.berita_id = bh.berita_id $where GROUP BY bh.hashtag_name ORDER BY jumlah DESC, bh.hashtag_name ASC $limit_query";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			echo "$query<br>";
			die($e->getMessage());
		}
		return $stmt->fetchAll();
	}

	function updateCountView($id) {
		$event_identifier = getdate()[0];
		$sql = "
		UPDATE berita SET 
		view_count = view_count + 1, 
		view_count_week = view_count_week + 1,
		view_count_month = view_count_month + 1,
		view_count_year = view_count_year + 1
		WHERE berita_id = $id;
		CREATE EVENT decrease_berita_week_$event_identifier
    		ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 7 DAY
    		DO
      			UPDATE berita SET view_count_week = view_count_week - 1
      			WHERE berita_id = $id;
      	CREATE EVENT decrease_berita_month_$event_identifier
    		ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 MONTH
    		DO
      			UPDATE berita SET view_count_month = view_count_month - 1
      			WHERE berita_id = $id;
      	CREATE EVENT decrease_berita_year_$event_identifier
    		ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 YEAR
    		DO
      			UPDATE berita SET view_count_year = view_count_year - 1
      			WHERE berita_id = $id;";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
			// print_r($stmt->fetchAll());die;

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	function getSingleJurusan($id) {
		$sql = "SELECT *, j.file_directory as file FROM jurusan as j LEFT JOIN departement as d ON j.departement_id=d.departement_id WHERE j.jurusan_id = $id";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);	
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		return $stmt->fetch();
	}

	function getSingleDepartement($id) {
		$sql = "SELECT d.departement_name, d.departement_id, d.departement_description, d.file_directory, j.jurusan_id, j.jurusan_name FROM jurusan as j INNER JOIN departement as d ON j.departement_id = d.departement_id WHERE d.departement_id = $id";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		return $stmt->fetchAll();
	}

	function postComment($data) {
		$sql = "INSERT INTO komentar (berita_id, nama, email, website, komentar_text) VALUES ($data->berita_id, '$data->nama', '$data->email', '$data->website', '$data->comment')";
		if(!is_null($data->reply_to)) {
			$sql = "INSERT INTO komentar (berita_id, nama, email, website, komentar_text, reply_to) VALUES ($data->berita_id, '$data->nama', '$data->email', '$data->website', '$data->comment', $data->reply_to)";
		}
		// die($sql);
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			die($e->getMessage());
		}

	}

	function getComment($berita_id, $ts_only = FALSE) { 
		$sql = "SELECT * FROM komentar WHERE berita_id = $berita_id ORDER BY komentar_date ASC";
		if($ts_only)
			$sql .= "AND reply_to IS NULL";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		return $stmt->fetchAll();
	}

	function getSingleComment($comment_id) {
		$sql = "SELECT * FROM komentar WHERE komentar_id = $comment_id ";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		return $stmt->fetch();
	}
}