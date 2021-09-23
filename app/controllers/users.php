<?php

class Users extends Controller {
	public function __construct(){
		parent::__construct();
	}

	public function Index($value='')
	{
		check_log($this);
		$data['components'] = [
			'header', 
			'sidebar', 
			'footer'
		];
		$data['title'] = "Users";
		$data['content'] = "backend/users/table";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\"",
			"href=\"".ASSETS_URL."css/font-awesome.min.css\""
		];
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/popper.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\""
		];

		$this->model("Model_Users", "model");
		$data['data']['table'] = $this->model->getAllData();

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search", "");
		$perPage = getGet("per_page", 10);
        $page = getGet('page', 1);
        $order = getGet('order_by', "username ASC");

        $role = getRoleList();

		$this->model("Model_Users", "model");
		$previousPage = $page - 1;
        $nextPage = $page + 1;
        $pageRange = 2;

        $all_filtered_content = $this->model->getFilteredData($search);
        $filtered_content = $this->model->getTable($search, $perPage, $page, $order);

        $totalPage = (int) ceil(count($all_filtered_content) / $perPage);
        $isBeginPage = $page == 1;
        $isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/users/edit/$value->user_id\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('users', 'user_id', $value->user_id, 'admin-ea/users/deleteprocess')\"><i class=\"fa fa-trash\"></i></button>";

			$label_active = $value->isactive ? getLabel(true, $value->user_id) : getLabel(false, $value->user_id);

			$show_rule = $role[$value->role]->ROLE_NAME;

			$html .= "<tr><td>$no</td>
			<td>$value->username</td>
			<td>$show_rule</td>
			<td>$label_active</td>
			<td>$btn_edit $btn_hapus</td></tr>";
		}

		// PAGINATION

		$pagination = "";
		$begin_disabled = $isBeginPage ? "disabled" : "";
        $pagination .= "<li class=\"page-item $begin_disabled\"><a class=\"page-link\" onclick=\"render(1)\" style=\"cursor : pointer\" title=\"Page 1\"><<</a></li>";
        $pagination .= "<li class=\"page-item $begin_disabled\"><a class=\"page-link\" onclick=\"render($previousPage)\" style=\"cursor : pointer\" title=\"Page $previousPage\">Previous</a></li>";

        for ($x = $page - $pageRange; $x < (($page + $pageRange) + 1); $x++) {
            if ($x > 0 && $x <= $totalPage) {
                $pagination .= $x == $page ? "<li class=\"page-item active\" data-page=\"$x\"><a class=\"page-link\" style=\"cursor : pointer\">$x</a></li>" : "<li class=\"page-item\"  data-page=\"$x\"><a class=\"page-link\" onclick=\"render($x)\" style=\"cursor : pointer\">$x</a></li>";
            }
        }

        $last_disabled = $isLastPage ? "disabled" : "";
        $pagination .= "<li class=\"page-item $last_disabled\"><a class=\"page-link\" onclick=\"render($nextPage)\" style=\"cursor : pointer\" title=\"Page $nextPage\">Next</a></li>";
        $pagination .= "<li class=\"page-item $last_disabled\"><a class=\"page-link\" onclick=\"render($totalPage)\" style=\"cursor : pointer\" title=\"Page $totalPage\">>></a></li>";
        
		$return_array = array('CONTENT' => preg_replace(['/>[ \s]+</'], ['><'], $html), 'PAGINATION' => $pagination);
		echo json_encode($return_array);
	}

	public function add() {
		check_log($this);
		$data['components'] = [
			'header', 
			'sidebar', 
			'footer'
		];
		$data['title'] = "Dashboard";
		$data['content'] = "backend/users/form";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\""
		];	
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\""
		];

		$this->model("Model_Users", "model");
		$data['data']['role'] = getRoleList();
		$data['data']['type'] = "Add";

		$this->view("backend/index", $data);
	}

	public function edit($id = NULL) {
		check_log($this);
		if(!$id)
			die("akses ditolak");

		$data['components'] = [
			'header', 
			'sidebar', 
			'footer'
		];
		$data['title'] = "User - Edit";
		$data['content'] = "backend/users/form";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\""
		];
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\""
		];

		$this->model("Model_Users", "users");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->users->getSingleData($id);
		$data['data']['role'] = getRoleList();
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$data = new StdClass();
		$data->username = $_POST["username"];
		$data->pswd = !empty($_POST["password"]) ? md5($_POST["password"]) : NULL;
		$data->isactive = isset($_POST['isactive']) ? "true" : "false";
		$data->fullname = getPost("fullname");
		$data->role = getPost("role");
		
		$this->model("Model_Users", "users");
		$query = ""; 
		$type  = "";
		if($id === NULL) {
			$query = $this->users->insertData($data);
			$type = "Tambah";
		} else {
			$query = $this->users->updateData($data, $id);
			$type = "Edit";
		}

		if($query)
			echo json_response("BERHASIL", "Sukses $type Data");
		else
			echo json_response("GAGAL", "Gagal $type Data");
	}

	public function deleteprocess() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal Hapus Data"));
		$this->model("Model_Users", "users");
		$query = $this->users->deleteData($id);

		if($query)
			echo json_response("BERHASIL", "Sukses Hapus Data");
		else
			echo json_response("GAGAL", "Gagal Hapus Data");
	}

	public function toggle() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal"));
		$boolean = getPost("boolean", '0');

		$this->model("Model_Users", "users");
		$query = $this->users->toggleActive($boolean, $id);
		
		if($query)
			echo json_response("BERHASIL", "Sukses");
		else
			echo json_response("GAGAL", "Gagal");
	}

	public function check() {
		$username = getPost("username");
		$this->model("Model_Users", "users");
		$query = $this->users->getUsername($username);
		$is_exist = !empty($query);

		if($is_exist)
			echo TRUE;
		else
			echo FALSE;
	}
}