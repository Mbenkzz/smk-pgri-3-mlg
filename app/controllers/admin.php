<?php

	/**
	 * 
	 */
	class Admin extends Controller{
		
		function __construct()
		{
			parent::__construct();
		}

		function Index() {
			if(!isset($_SESSION['username'])) {
				$this->view("login");
			} else {
				$this->dashboard();
			}
		}

		function dashboard() {
			check_log($this);
			$data['components'] = [
				'header', 
				'sidebar', 
				'footer'
			];
			$data['title'] = "Dashboard";
			$data['content'] = "backend/dashboard/index";
			$data['stylesheets'] = [
				"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
				"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\""
			];
			$data['scripts']= [
				"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\""
			];
			$this->view("backend/index", $data);
		}

		function login() {
			if(!isset($_POST['username']) OR !isset($_POST['password']))
				die("DENIED");
			$this->model("Model_Auth", "auth");
			$login = $this->auth->getUser($_POST['username'], md5($_POST['password']));
			if($login) {
				if($login->isactive == 1) {
					$_SESSION['username'] = $login->username;
					$_SESSION['role'] = $login->role;
					if($_SESSION['role'] == "ADMIN")
						echo json_encode(["RESULT"=> "success", "MESSAGE" => "Anda Berhasil Masuk", "URL"=> "admin-ea/admin"]);
					else
						echo json_encode(["RESULT"=> "success", "MESSAGE" => "Anda Berhasil Masuk", "URL"=> "admin-ea/berita"]);
				} else {
					echo json_encode(["RESULT"=> "danger", "MESSAGE" => "Akun Ini Tidak Aktif"]);
				}
				
			} else {
				echo json_encode(["RESULT"=> "danger", "MESSAGE" => "Username atau Password anda salah"]);
			}
		}

		function logout() {
			session_unset();
			session_destroy();
			redirect("admin-ea/admin");
		}
	}