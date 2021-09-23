<?php

class Partner extends Controller {
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
		$data['title'] = "Partner";
		$data['content'] = "backend/partner/table";
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

		$this->model("Model_Partner", "partner");

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search");
		$perPage = getGet("per_page", 10);
		$page = getGet('page', 1);
		$order = getGet('order_by', "partner_name ASC");

		$this->model("Model_Partner", "partner");
		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$all_filtered_content = $this->partner->getFilteredData($search);
		$filtered_content = $this->partner->getTable($search, $perPage, $page, $order);

		$totalPage = (int) ceil(count($all_filtered_content) / $perPage);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/partner/edit/$value->partner_id\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('partner', 'partner_id', $value->partner_id, 'admin-ea/partner/deleteprocess')\"><i class=\"fa fa-trash\"></i></button>";

			$label_active = $value->isactive ? getLabel(true, $value->partner_id) : getLabel(false, $value->partner_id);

			$updated_at = FullDateFormat($value->updated_at, 'd M Y H:i:s');

			if (!empty($value->file_directory)) {
				$url = BASE_URL . $value->file_directory;
				$image = "<img style=\"max-width: 100px; height: auto; max-height: 50px\" src=\"$url\" class=\"rounded mx-auto d-block my-2\">";
			} else {
				$image = "";
			}

			$detailed_info = "";
			if(!empty($value->partner_address))
				$detailed_info .= "<b>Alamat</b> : $value->partner_address<br>";
			if(!empty($value->partner_phone))
				$detailed_info .= "<b>Contact Person</b> : $value->partner_phone<br>";
			if(!empty($value->partner_email))
				$detailed_info .= "<b>Email</b> : $value->partner_email";

			$html .= "<tr><td>$no</td>
			<td>$image</td>
			<td>$value->partner_name</td>
			<td>$detailed_info</td>
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
		$data['title'] = "Partner - Tambah";
		$data['content'] = "backend/partner/form";
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

		$this->model("Model_Partner", "partner");
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
		$data['title'] = "Partner - Edit";
		$data['content'] = "backend/partner/form";
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

		$this->model("Model_Partner", "partner");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->partner->getSingleData($id);
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$partner = new StdClass();
		$partner->name = getPost("partner_name");
		$partner->address = getPost("partner_address");
		$partner->phone = getPost("partner_phone");
		$partner->email = getPost("partner_email");
		$partner->directory = "";
		$partner->isactive = isset($_POST['isactive']) ? "1" : "0";

		$reason = NULL;
		$is_upload = isset($_FILES["logo_image"]["name"]) && !empty($_FILES["logo_image"]["name"]);
		if ($is_upload) {
			switch ($_FILES['logo_image']['error']) {
				case UPLOAD_ERR_OK:
				case UPLOAD_ERR_NO_FILE:
				break;
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
				die(json_response("GAGAL", "Ukuran Terlalu besar"));
				default:
				die(json_response("GAGAL", "Unknown Error #%&#^#$"));
			}
			$filename = $_FILES["logo_image"]["name"];
			$partner->directory = "public/images/uploads/" . $filename;
			$target_dir = ROOT_PATH . "public/images/uploads/";
			$target_file = $target_dir . basename($filename);
			$reason = "";
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["logo_image"]["tmp_name"]);
			if($check === false) {
				die(json_response("GAGAL", "File yang anda masukkan bukan gambar."));
			}
			$tmp = explode(".", $_FILES["logo_image"]["name"]);	
			$filename = round(microtime(true)) . '.' . end($tmp);
			$partner->directory = "public/images/uploads/" . $filename;
// Check file size
			if ($_FILES["logo_image"]["size"] > (2*1024*1024)) {
				die(json_response("GAGAL", "File terlalu besar (maks 2MB)"));
			}
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				die(json_response("GAGAL", "Format harus jpg, jpeg, png, gif"));
			}
			if (!move_uploaded_file($_FILES["logo_image"]["tmp_name"], $partner->directory)) {
				die(json_response("GAGAL", "Unknown Error"));
			}
		}


		$this->model("Model_Partner", "partner");
		$partner->acted_by = getSessionUser($this, "user_id");
		$query = NULL; 
		$type  = "";
		if($id === NULL) {
			$query = $this->partner->insertData($partner);
			$type = "Tambah";
		}
		else {
			$query = $this->partner->updateData($partner, $id);
			$type = "Edit";
		}

		if($query) {
			echo json_response("BERHASIL", "Sukses $type Data");
		}
		else {
			echo json_response("GAGAL", "Gagal $type Data");
		}
	}

	public function deleteprocess() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal Hapus Data"));
		$this->model("Model_Partner", "partner");
		$row = $this->partner->getSingleData($id);
		$query = $this->partner->deleteData($id);

		if($query){
			if (file_exists($row->file_directory))
				unlink($row->file_directory);
			echo json_response("BERHASIL", "Sukses Hapus Data");
		} 
		else {
			echo json_response("GAGAL", "Gagal Hapus Data");
		}
	}

	public function toggle() {
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal"));
		$boolean = getPost("boolean", '0');

		$this->model("Model_Partner", "partner");
		$query = $this->partner->toggleActive($boolean, $id);

		if($query)
			echo json_response("BERHASIL", "Sukses");
		else
			echo json_response("GAGAL", "Gagal");
	}
}