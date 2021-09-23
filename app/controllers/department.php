<?php

class Department extends Controller {
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
		$data['title'] = "Department";
		$data['content'] = "backend/department/table";
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

		$this->model("Model_Department", "model");

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search");
		$perPage = getGet("per_page", 10);
		$page = getGet('page', 1);
		$order = getGet('order_by', "departement_name ASC");

		$this->model("Model_Department", "departemen");
		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$all_filtered_content = $this->departemen->getFilteredData($search);
		$filtered_content = $this->departemen->getTable($search, $perPage, $page, $order);

		$totalPage = (int) ceil(count($all_filtered_content) / $perPage);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/department/edit/$value->departement_id\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('department', 'department_id', $value->departement_id, 'admin-ea/department/deleteprocess')\"><i class=\"fa fa-trash\"></i></button>";

			$label_active = $value->isactive ? getLabel(true, $value->departement_id) : getLabel(false, $value->departement_id);

			$updated_at = FullDateFormat($value->updated_at, 'd M Y H:i:s');
			$description = convertToText($value->departement_description, 40);

			$html .= "<tr><td>$no</td>
			<td>$value->departement_name</td>
			<td>$description</td>
			<td>$updated_at</td>
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
		$data['title'] = "Departemen - Tambah";
		$data['content'] = "backend/department/form";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\""
		];	
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/ckeditor/ckeditor.js\""
		];

		$this->model("Model_Department", "model");
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
		$data['title'] = "Departemen - Edit";
		$data['content'] = "backend/department/form";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\""
		];
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/ckeditor/ckeditor.js\""
		];

		$this->model("Model_Department", "department");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->department->getSingleData($id);
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$data = new StdClass();
		$data->departmentname = getPost("dep_name");
		$data->description = getPost("input_depdesc");
		$data->directory = "";
		$data->isactive = isset($_POST['isactive']) ? "1" : "0";

		$reason = NULL;
		$is_upload = isset($_FILES["input_depfile"]["name"]) && !empty($_FILES["input_depfile"]["name"]);
		if ($is_upload) {
			switch ($_FILES['input_depfile']['error']) {
				case UPLOAD_ERR_OK:
				case UPLOAD_ERR_NO_FILE:
				break;
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
				die(json_response("GAGAL", "Ukuran Terlalu besar"));
				default:
				die(json_response("GAGAL", "Unknown Error #%&#^#$"));
			}
			$filename = $_FILES["input_depfile"]["name"];
			$data->directory = "public/images/uploads/" . $filename;
			$target_dir = ROOT_PATH . "public/images/uploads/";
			$target_file = $target_dir . basename($filename);
			
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["input_depfile"]["tmp_name"]);
			if($check === false) {
				die(json_response("GAGAL", "File yang anda masukkan bukan gambar."));
			}
			$tmp = explode(".", $_FILES["input_depfile"]["name"]);
			$filename = round(microtime(true)) . '.' . end($tmp);
			$data->directory = "public/images/uploads/" . $filename;
// Check file size
			if ($_FILES["input_depfile"]["size"] > (2*1024*1024)) {
				die(json_response("GAGAL", "File terlalu besar (maks 2MB)"));
			}
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				die(json_response("GAGAL", "Format harus jpg, jpeg, png, gif"));
			}
			if (!move_uploaded_file($_FILES["input_depfile"]["tmp_name"], $data->directory)) {
				die(json_response("GAGAL", "Unknown Error"));
			}
		}

		$this->model("Model_Department", "department");
		$data->acted_by = getSessionUser($this, "user_id");
		$query = NULL; 
		$type  = "";
		if($id === NULL) {
			$query = $this->department->insertData($data);
			$type = "Tambah";
		} else {
			$query = $this->department->updateData($data, $id);
			$type = "Edit";
		}

		if($query) {
			echo json_response("BERHASIL", "Sukses $type Data");
		}
		else {
			if (file_exists($data->directory) && $is_upload) {
				unlink($data->directory);
			}
			echo json_response("GAGAL", "Gagal $type Data");
		}
			
	}

	public function deleteprocess() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal Hapus Data"));
		$this->model("Model_Department", "department");
		$row = $this->department->getSingleData($id);
		$query = $this->department->deleteData($id);

		if($query){
			if (file_exists($row->file_directory))
				unlink($row->file_directory);
			echo json_response("BERHASIL", "Sukses Hapus Data");
		} else {
			echo json_response("GAGAL", "Gagal Hapus Data");
		}
	}

	public function toggle() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal"));
		$boolean = getPost("boolean", '0');

		$this->model("Model_Department", "department");
		$query = $this->department->toggleActive($boolean, $id);

		if($query)
			echo json_response("BERHASIL", "Sukses");
		else
			echo json_response("GAGAL", "Gagal");
	}
}