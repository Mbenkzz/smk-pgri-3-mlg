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
					session_start();
					$_SESSION['username'] = $_POST['username'];
					redirect("admin-ea/admin");
				} else {
					die("akun ini tidak aktif");
				}
				
			} else {
				echo "Username atau Password anda salah";
			}
		}

		function logout() {
			session_unset();
			session_destroy();
			redirect("admin-ea/admin");
		}
	}