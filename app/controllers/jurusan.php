<?php

class Jurusan extends Controller {
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
		$data['title'] = "Jurusan";
		$data['content'] = "backend/jurusan/table";
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

		$this->model("Model_Jurusan", "jurusan");

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search");
		$perPage = getGet("per_page", 10);
		$page = getGet('page', 1);
		$order = getGet('order_by', "jurusan_name ASC");

		$this->model("Model_Jurusan", "jurusan");
		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$all_filtered_content = $this->jurusan->getFilteredData($search);
		$filtered_content = $this->jurusan->getTable($search, $perPage, $page, $order);

		$totalPage = (int) ceil(count($all_filtered_content) / $perPage);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/jurusan/edit/$value->jurusan_id\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('jurusan', 'jurusan_id', $value->jurusan_id, 'admin-ea/jurusan/deleteprocess')\"><i class=\"fa fa-trash\"></i></button>";

			$label_active = $value->isactive ? getLabel(true, $value->jurusan_id) : getLabel(false, $value->jurusan_id);

			$updated_at = FullDateFormat($value->updated_at, 'd M Y H:i:s');
			$description = convertToText($value->jurusan_description, 40);

			$html .= "<tr><td>$no</td>
			<td>$value->jurusan_name</td>
			<td>$value->departement_name</td>
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
		$data['title'] = "Jurusan - Tambah";
		$data['content'] = "backend/jurusan/form";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\"",
			"href=\"".ASSETS_URL."backend/scripts/select2/dist/css/select2.min.css\""
		];	
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/ckeditor/ckeditor.js\"",
			"src=\"".ASSETS_URL."backend/scripts/select2/dist/js/select2.min.js\""
		];

		$this->model("Model_Jurusan", "jurusan");
		$this->model("Model_Department", "departemen");

		$data['data']['type'] = "Add";
		$data['data']['departemen'] = $this->departemen->getAllData();

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
		$data['title'] = "Jurusan - Edit";
		$data['content'] = "backend/jurusan/form";
		$data['stylesheets'] = [
			"href=\"".ASSETS_URL."backend/stylesheets/bootstrap.min.css\"", 
			"href=\"".ASSETS_URL."backend/stylesheets/dashboard.css\"",
			"href=\"".ASSETS_URL."backend/stylesheets/table.css\"",
			"href=\"".ASSETS_URL."backend/scripts/select2/dist/css/select2.min.css\""
		];
		$data['scripts']= [
			"src=\"".ASSETS_URL."backend/scripts/jquery.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/bootstrap.min.js\"",
			"src=\"".ASSETS_URL."backend/scripts/ckeditor/ckeditor.js\"",
			"src=\"".ASSETS_URL."backend/scripts/select2/dist/js/select2.min.js\""
		];

		$this->model("Model_Jurusan", "jurusan");
		$this->model("Model_Department", "departemen");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->jurusan->getSingleData($id);
		$data['data']['departemen'] = $this->departemen->getAllData();
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$data = new StdClass();
		$data->jurusanname = getPost("jur_name");
		$data->departmentid = getPost("dep_id");
		$data->description = getPost("input_jurdesc");
		$data->directory = "";
		$data->isactive = isset($_POST['isactive']) ? "1" : "0";

		$reason = NULL;
		$is_upload = isset($_FILES["jur_file"]["name"]) && !empty($_FILES["jur_file"]["name"]);
		if ($is_upload) {
			switch ($_FILES['jur_file']['error']) {
				case UPLOAD_ERR_OK:
				case UPLOAD_ERR_NO_FILE:
				break;
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
				die(json_response("GAGAL", "Ukuran Terlalu besar"));
				default:
				die(json_response("GAGAL", "Unknown Error #%&#^#$"));
			}
			$filename = $_FILES["jur_file"]["name"];
			$data->directory = "public/images/uploads/" . $filename;
			$target_dir = ROOT_PATH . "public/images/uploads/";
			$target_file = $target_dir . basename($filename);
			$reason = "";
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["jur_file"]["tmp_name"]);
			if($check === false) {
				die(json_response("GAGAL", "File yang anda masukkan bukan gambar."));
			}
			$tmp = explode(".", $_FILES["jur_file"]["name"]);
			$filename = round(microtime(true)) . '.' . end($tmp);
			$data->directory = "public/images/uploads/" . $filename;
// Check file size
			if ($_FILES["jur_file"]["size"] > (2*1024*1024)) {
				die(json_response("GAGAL", "File terlalu besar (maks 2MB)"));
			}
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				die(json_response("GAGAL", "Format harus jpg, jpeg, png, gif"));
			}
			if (!move_uploaded_file($_FILES["jur_file"]["tmp_name"], $data->directory)) {
				die(json_response("GAGAL", "Unknown Error"));
			}
		}

		$this->model("Model_Jurusan", "jurusan");
		$data->acted_by = getSessionUser($this, "user_id");
		$query = NULL; 
		$type  = "";
		if($id === NULL) {
			$query = $this->jurusan->insertData($data);
			$type = "Tambah";
		} else {
			$query = $this->jurusan->updateData($data, $id);
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
		$this->model("Model_Jurusan", "jurusan");
		$row = $this->jurusan->getSingleData($id);
		$query = $this->jurusan->deleteData($id);

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

		$this->model("Model_Jurusan", "jurusan");
		$query = $this->jurusan->toggleActive($boolean, $id);

		if($query)
			echo json_response("BERHASIL", "Sukses");
		else
			echo json_response("GAGAL", "Gagal");
	}
}