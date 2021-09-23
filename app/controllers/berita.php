<?php

class Berita extends Controller {
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
		$data['title'] = "Berita";
		$data['content'] = "backend/berita/table";
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

		$this->model("Model_Berita", "berita");

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search");
		$perPage = getGet("per_page", 10);
		$page = getGet('page', 1);
		$order = getGet('order_by', "updated_at DESC");

		$this->model("Model_Berita", "berita");
		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$all_filtered_content = $this->berita->getFilteredData($search);
		$filtered_content = $this->berita->getTable($search, $perPage, $page, $order);

		$totalPage = (int) ceil(count($all_filtered_content) / $perPage);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_preview = "<a class=\"btn btn-warning mx-1\" href=\"".BASE_URL."admin-ea/berita/preview/$value->berita_id\" role=\"button\"><i class=\"fa fa-eye\" title=\"Lihat\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('berita', 'berita_id', $value->berita_id, 'admin-ea/berita/deleteprocess')\" title=\"Hapus\"><i class=\"fa fa-trash\"></i></button>";

			if($value->isapprove) {
				$label_active = "<button type=\"button\" class=\"btn btn-sm btn-primary\"><i class=\"fa fa-check mr-1\"></i>Approved</button>";
				$btn_edit = "";
			} else {
				$label_active = $value->isactive ? getLabel(true, $value->berita_id) : getLabel(false, $value->berita_id);
				$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/berita/edit/$value->berita_id\" role=\"button\"><i class=\"fa fa-pencil\" title=\"Edit\"></i></a>";
			}

			$updated_at = FullDateFormat($value->updated_at, 'd M Y H:i:s');
			$description = convertToText($value->berita_description, 40);
			if (!empty($value->file_directory)) {
				$url = BASE_URL . $value->file_directory;
				$image = "<img style=\"width: 120px; height: 90px\" src=\"$url\" class=\"rounded mx-auto d-block\">";
			} else {
				$image = "<img style=\"width: 120px; height: 90px\" src=\"". ASSETS_URL ."/images/no-image.jpg\" class=\"rounded mx-auto d-block\">";
			}
			

			$html .= "<tr><td>$no</td>
			<td>$image</td>
			<td>$value->berita_title</td>
			<td>$description</td>
			<td>$updated_at</td>
			<td>$label_active</td>
			<td>$btn_edit $btn_preview $btn_hapus</td></tr>";
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
		$data['title'] = "Berita - Tambah";
		$data['content'] = "backend/berita/form";
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
			"src=\"".ASSETS_URL."backend/scripts/select2/dist/js/select2.full.min.js\""
		];

		$this->model("Model_Berita", "berita");
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
		$data['title'] = "Berita - Edit";
		$data['content'] = "backend/berita/form";
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
			"src=\"".ASSETS_URL."backend/scripts/select2/dist/js/select2.full.min.js\""
		];

		$this->model("Model_Berita", "berita");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->berita->getSingleData($id);
		$data['data']['tags'] = $this->berita->getHashtag($id);
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$data = new StdClass();
		$data->title = getPost("input_title");
		$data->description = getPost("input_description");
		$data->tags = getPost("input_tag", []);
		$data->directory = "";
		$data->isactive = isset($_POST['isactive']) ? "1" : "0";

		$reason = NULL;
		$is_upload = isset($_FILES["input_file"]["name"]) && !empty($_FILES["input_file"]["name"]);
		if ($is_upload) {
			switch ($_FILES['input_file']['error']) {
				case UPLOAD_ERR_OK:
				case UPLOAD_ERR_NO_FILE:
				break;
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
				die(json_response("GAGAL", "Ukuran Terlalu besar"));
				default:
				die(json_response("GAGAL", "Unknown Error #%&#^#$"));
			}
			$filename = $_FILES["input_file"]["name"];
			$data->directory = "public/images/uploads/" . $filename;
			$target_dir = ROOT_PATH . "public/images/uploads/";
			$target_file = $target_dir . basename($filename);
			$reason = "";
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["input_file"]["tmp_name"]);
			if($check === false) {
				die(json_response("GAGAL", "File yang anda masukkan bukan gambar."));
			}
			$tmp = explode(".", $_FILES["input_file"]["name"]);
			$filename = round(microtime(true)) . '.' . end($tmp);
			$data->directory = "public/images/uploads/" . $filename;
// Check file size
			if ($_FILES["input_file"]["size"] > (2*1024*1024)) {
				die(json_response("GAGAL", "File terlalu besar (maks 2MB)"));
			}
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				die(json_response("GAGAL", "Format harus jpg, jpeg, png, gif"));
			}
			if (!move_uploaded_file($_FILES["input_file"]["tmp_name"], $data->directory)) {
				die(json_response("GAGAL", "Unknown Error"));
			}
		}

		$this->model("Model_Berita", "berita");
		$data->acted_by = getSessionUser($this, "user_id");
		$query = NULL; 
		$type  = "";
		if($id === NULL) {
			$query = $this->berita->insertData($data);
			$type = "Tambah";
			$id = $query;
		} else {
			$query = $this->berita->updateData($data, $id);
			$type = "Edit";
		}

		if($query) {
			$this->berita->addHashtag($data, $id);
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
		$this->model("Model_Berita", "berita");
		$row = $this->berita->getSingleData($id);
		$query = $this->berita->deleteData($id);

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

		$this->model("Model_Berita", "berita");
		$query = $this->berita->toggleActive($boolean, $id);

		if($query)
			echo json_response("BERHASIL", "Sukses");
		else
			echo json_response("GAGAL", "Gagal");
	}

	public function check() {
		$title = getPost("title");
		$this->model("Model_Berita", "berita");
		$query = $this->berita->getJudul($title);
		$is_exist = !empty($query);

		if($is_exist)
			echo TRUE;
		else
			echo FALSE;
	}

	public function preview($id) {
		$this->model("Model_Berita", "berita");
		$data['data'] = $this->berita->getPreviewBerita($id);
		$data['jenis'] = "berita";

		$this->view("backend/preview.php", $data);
	}

	public function approve() {
		$id = getPost("value_id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal"));

		$this->model("Model_Berita", "berita");
		$query = $this->berita->toggleApprove($id);

		if($query)
			echo json_response("BERHASIL", "Sukses Approve Data");
		else
			echo json_response("GAGAL", "Gagal");
	}

	public function select_hashtag(){
        $search = getRequest('search');
        $not_in = getGet('not_in');
        if(!empty($not_in))
        	$not_in = "\"$not_in\"";

        $this->model("Model_Berita", "berita");
        $result = $this->berita->getSelectHashtag($search, $not_in);

        $json = [];
        foreach ($result as $key => $value) {
            $json[] = ['id' => strtolower($value), 'text' => ucwords($value)];
        }

        echo json_encode($json);
    }

	public function cetak_single($id){
		$id = getPost('id', $id);
		$this->library("fpdf181/fpdf", "pdf"); // creates $this->pdf variable
		$this->model("Model_Berita", "berita");
		$data = $this->berita->getSingleData($id);
		$image_url = BASE_URL . ($data->file_directory);
		list($image_width, $image_height, $image_type, $image_attr) = getimagesize($image_url);
		$image_resized_height = 60;
		$image_resized_width = ($image_width / $image_height) * $image_resized_height;

		$paragraph = str_replace('</p>', '', $data->berita_description);
		$paragraph_array = explode('<p>', $paragraph);

		$this->pdf->init();
		$this->pdf->addPage();
		$logo_url = ASSETS_URL.'frontend/images/cropped-ico1-192x192.png';
		list($logo_w, $logo_h) = getimagesize($logo_url);
		$logo_w = 20 * ($logo_w / $logo_h);
		$this->pdf->Image($logo_url, $this->pdf->GetX(), $this->pdf->GetY(), $logo_w, 20);

		$this->pdf->SetFont("Arial", "", 8);
		$this->pdf->Cell(0,10, ExtendsDate($data->updated_at, 'Dn, d Mn Y', FALSE), 0, 0, 'R');
		$this->pdf->Ln();
		$this->pdf->Cell(0,10, 'Penulis : ' . get_user_data($this, $data->created_by)->fullname, 0, 0, 'R');
		$this->pdf->Ln();

		$this->pdf->SetFont("Times", "B", 16);
		$this->pdf->MultiCell(0, 10, ucwords($data->berita_title), 0, 'C');
		$this->pdf->Ln();

		$this->pdf->Image($image_url, ($this->pdf->GetPageWidth()/2) - ($image_resized_width/2), NULL, NULL, $image_resized_height);
		$this->pdf->Ln();

		$this->pdf->SetFont("Times", "", 11);
		foreach ($paragraph_array as $value) {
			$this->pdf->MultiCell(0, 6, strip_tags("      $value"), 0, 'J');
		}

		$title = strtolower(str_replace(' ', '_', trim($data->berita_title)));
		$this->pdf->Output('I',"$title.pdf", TRUE);

	}
}