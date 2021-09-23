<?php

class Sosmed extends Controller {
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
		$data['title'] = "Sosmed";
		$data['content'] = "backend/sosmed/table";
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

		$this->model("Model_Sosmed", "sosmed");

		$this->view("backend/index", $data);
	}

	public function table() {
		$search = getGet("search");
		$perPage = getGet("per_page", 10);
		$page = getGet('page', 1);
		$order = getGet('order_by', "sosmed_platform ASC");

		$this->model("Model_Sosmed", "sosmed");
		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$all_filtered_content = $this->sosmed->getFilteredData($search);
		$filtered_content = $this->sosmed->getTable($search, $perPage, $page, $order);

		$totalPage = (int) ceil(count($all_filtered_content) / $perPage);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$html = "";
		foreach ($filtered_content as $key => $value) {
			$no = (($page - 1) * $perPage) + $key + 1;
			$btn_edit = "<a class=\"btn btn-info mx-1\" href=\"".BASE_URL."admin-ea/sosmed/edit/$value->sosmed_id\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>";
			$btn_hapus = "<button type=\"button\" class=\"btn btn-danger mx-1\" onclick=\"deleteConfirmation('sosmed', 'sosmed_id', $value->sosmed_id, 'admin-ea/sosmed/deleteprocess')\" disabled><i class=\"fa fa-trash\"></i></button>";
			$btn_hapus = "";

			$label_active = $value->isactive ? getLabel(true, $value->sosmed_id) : getLabel(false, $value->sosmed_id);

			$updated_at = FullDateFormat($value->updated_at, 'd M Y H:i:s');

			$html .= "<tr><td>$no</td>
			<td>$value->sosmed_platform</td>
			<td>$value->sosmed_akunid</td>
			<td>$updated_at</td>
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
		http_response_code(404);die;
		check_log($this);
		$data['components'] = [
			'header', 
			'sidebar', 
			'footer'
		];
		$data['title'] = "Sosmed - Tambah";
		$data['content'] = "backend/sosmed/form";
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

		$this->model("Model_Sosmed", "sosmed");
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
		$data['title'] = "Sosmed - Edit";
		$data['content'] = "backend/sosmed/form";
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

		$this->model("Model_Sosmed", "sosmed");
		// $data['data'] passed into php content
		$data['data']['type'] = "Edit";
		$data['data']['values'] = $this->sosmed->getSingleData($id);
		// print_r($data);die;

		$this->view("backend/index", $data);
	}

	public function formprocess($id = NULL) {
		$sosmed = new StdClass();
		$sosmed->akun = getPost("sosmed_akun");
		$sosmed->tautan = getPost("sosmed_tautan");
		$sosmed->isactive = isset($_POST['isactive']) ? "1" : "0";

		$this->model("Model_Sosmed", "sosmed");
		$sosmed->acted_by = getSessionUser($this, "user_id");
		$query = NULL; 
		$type  = "";
		if($id === NULL) {
			$query = $this->sosmed->insertData($sosmed);
			$type = "Tambah";
		} else {
			$query = $this->sosmed->updateData($sosmed, $id);
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
		http_response_code(404);die; // DISABLED DELETE ACTION
		$id = getPost("id");
		if (empty($id))
			die(json_response("GAGAL", "Gagal Hapus Data"));
		$this->model("Model_Sosmed", "sosmed");
		$row = $this->sosmed->getSingleData($id);
		$query = $this->sosmed->deleteData($id);

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

		$this->model("Model_Sosmed", "sosmed");
		$query = $this->sosmed->toggleActive($boolean, $id);

		if($query)
			echo json_response("BERHASIL", "Sukses");
		else
			echo json_response("GAGAL", "Gagal");
	}
}