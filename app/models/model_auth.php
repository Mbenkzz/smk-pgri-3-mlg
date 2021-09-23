<?php

/**
 * 
 */
class Model_Auth extends Model {
	
	function __construct() {
		parent::__construct();
	}

	function getUser($username, $password) {
		try {
			$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :user AND pswd = :pass");
			$stmt->bindParam(':user', $bind_username);
			$stmt->bindParam(':pass', $bind_password);

			$bind_username = $username;
			$bind_password = $password;
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e->getMessage();
			return FALSE;
		}
		return $stmt->fetch();	
	}
}