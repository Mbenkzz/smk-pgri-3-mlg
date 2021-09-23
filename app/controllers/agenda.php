<?php

class Agenda extends Controller {
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
		$data['title'] = "Agenda";
		$data['content'] = "backend/agenda/table";
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

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search");
		$perPage = getGet("per_page", 10);
		$page = getGet('page', 1);
		$order = getGet('order_by', "agenda_title ASC");

		$this->model("Model_Agenda", "agenda");
		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$all_filtered_content = $this->agenda->getFilteredData($search);
		$filtered_content = $this->agenda->getTable($search, $perPage, $page, $order);

		$totalPage = (int) ceil(count($all_filtered_content) / $perPage);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/agenda/edit/$value->agenda_id\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('agenda', 'agenda_id', $value->agenda_id, 'admin-ea/agenda/deleteprocess')\"><i class=\"fa fa-trash\"></i></button>";

			$label_active = $value->isactive ? getLabel(true, $value->agenda_id) : getLabel(false, $value->agenda_id);

			$updated_at = FullDateFormat($value->updated_at, 'd M Y H:i:s');
			$description = convertToText($value->agenda_description, 40);

			if (!empty($value->file_directory)) {
				$url = BASE_URL . $value->file_directory;
				$image = "<img style=\"width: 120px; height: 90px\" src=\"$url\" class=\"rounded mx-auto d-block\">";
			} else {
				$image = "<img style=\"width: 120px; height: 90px\" src=\"". ASSETS_URL ."/images/no-image.jpg\" class=\"rounded mx-auto d-block\">";
			}

			$html .= "<tr><td>$no</td>
			<td>$image</td>
			<td>$value->agenda_title</td>
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
		$data['title'] = "Agenda - Tambah";
		$data['content'] = "backend/agenda/form";
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

		$this->model("Model_Agenda", "agenda");
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
		$data['title'] = "Agenda - Edit";
		$data['content'] = "backend/agenda/form";
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

		$this->model("Model_Agenda", "agenda");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->agenda->getSingleData($id);
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$agenda = new StdClass();

		$agenda->title = getPost("agenda_title");
		$agenda->description = getPost("agenda_description");
		$agenda->start = getPost("agenda_start");
		$agenda->end = getPost("agenda_end");
		$agenda->directory = "";
		$agenda->isactive = isset($_POST['isactive']) ? "1" : "0";

		$reason = NULL;
		$is_upload = isset($_FILES["agenda_file"]["name"]) && !empty($_FILES["agenda_file"]["name"]);
		if ($is_upload) {
			switch ($_FILES['agenda_file']['error']) {
				case UPLOAD_ERR_OK:
				case UPLOAD_ERR_NO_FILE:
				break;
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
				die(json_response("GAGAL", "Ukuran Terlalu besar"));
				default:
				die(json_response("GAGAL", "Unknown Error #%&#^#$"));
			}
			$filename = $_FILES["agenda_file"]["name"];
			$agenda->directory = "public/images/uploads/" . $filename;
			$target_dir = ROOT_PATH . "public/images/uploads/";
			$target_file = $target_dir . basename($filename);
			$reason = "";
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["agenda_file"]["tmp_name"]);
			if($check === false) {
				die(json_response("GAGAL", "File yang anda masukkan bukan gambar."));
			}
// Check file size
			if ($_FILES["agenda_file"]["size"] > (2*1024*1024)) {
				die(json_response("GAGAL", "File terlalu besar (maks 2MB)"));
			}
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				die(json_response("GAGAL", "Format harus jpg, jpeg, png, gif"));
			}
			$tmp = explode(".", $_FILES["file"]["name"]);
			$filename = round(microtime(true)) . '.' . end($tmp);
			$agenda->directory = "public/images/uploads/" . $filename;
			if (!move_uploaded_file($_FILES["agenda_file"]["tmp_name"], $agenda->directory)) {
				die(json_response("GAGAL", "Unknown Error"));
			}
		}

		$this->model("Model_Agenda", "agenda");
		$agenda->acted_by = getSessionUser($this, "user_id");
		$query = NULL; 
		$type  = "";
		if($id === NULL) {
			$query = $this->agenda->insertData($agenda);
			$type = "Tambah";
		} else {
			$query = $this->agenda->updateData($agenda, $id);
			$type = "Edit";
		}

		if($query) {
			echo json_response("BERHASIL", "Sukses $type Data");
		}
		else {
			if (file_exists($agenda->directory) && $is_upload) {
				unlink($agenda->directory);
			}
			echo json_response("GAGAL", "Gagal $type Data");
		}
			
	}

	public function deleteprocess() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal Hapus Data"));
		$this->model("Model_Agenda", "agenda");
		$row = $this->agenda->getSingleData($id);
		$query = $this->agenda->deleteData($id);

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

		$this->model("Model_Agenda", "agenda");
		$query = $this->agenda->toggleActive($boolean, $id);

		if($query)
			echo json_response("BERHASIL", $boolean);
		else
			echo json_response("GAGAL", "Gagal");
	}

	public function check() {
		$title = getPost("title");
		$this->model("Model_Agenda", "agenda");
		$query = $this->agenda->getJudul($title);
		$is_exist = !empty($query);

		if($is_exist)
			echo TRUE;
		else
			echo FALSE;
	}

	public function preview($id) {
		$this->model("Model_Agenda", "agenda");
		$data['data'] = $this->agenda->getPreviewAgenda($id);
		$data['jenis'] = "agenda";

		$this->view("backend/preview.php", $data);
	}

	public function approve() {
		$id = getPost("value_id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal"));

		$this->model("Model_Agenda", "agenda");
		$query = $this->agenda->toggleApprove($id);

		if($query)
			echo json_response("BERHASIL", "Sukses Approve Data");
		else
			echo json_response("GAGAL", "Gagal");
	}
}