<?php

/**
 * 
 */
class Client extends Controller
{
	private $model;

	function __construct()
	{
		$this->model("Model_Client", "client");
		parent::__construct();
	}

	function Index() {

		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "light";
		$data['berita'] = $this->recent_post();
		$data['partner'] = $this->get_partner_logo();
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/index.php", $data);
	}

	function berita($id) {
		if (!isApprove($this, $id)){
			http_response_code(404);die;
		}

		$tags = $this->get_hashtag_post($id);

		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['data'] = $this->get_berita_data($id);
		$data['tags'] = "berita";
		$data['recent_post'] = $this->recent_post();
		$data['post_tag'] = $tags;
		$data['related_post'] = $this->get_related_post($tags, $id);
		$data['hashtag'] = $this->get_hashtag_list(10);
		$data['komentar'] = $this->client->getComment($id);
		$data["var_model"] = $this->client;
		$data['footer']['social'] = $this->get_social_links();
		// print_r($data['komentar']);die;
		if (!empty($data['data']->file_directory)) {
			$url = BASE_URL . $data['data']->file_directory;
		} else {
			$image = "<img style=\"width: 120px; height: 90px\" src=\"". ASSETS_URL ."/images/no-image.jpg\" class=\"rounded mx-auto d-block\">";
		}

		$this->view("frontend/berita_acara.php", $data);
	}

	function update_count_view() {
		$id = getPost('berita_id');
		if(empty($id)){
			http_response_code(404);die;
		}

		$jurusan_mentahan = $this->client->updateCountView($id);
	}

	function agenda($id) {
		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['data'] = $this->get_agenda_data($id);
		$data['tags'] = "agenda";
		$data['recent_post'] = $this->recent_post();
		$data['footer']['social'] = $this->get_social_links();
		if (!empty($data['data']->file_directory)) {
			$url = BASE_URL . $data['data']->file_directory;
		} else {
			$image = "<img style=\"width: 120px; height: 90px\" src=\"". ASSETS_URL ."/images/no-image.jpg\" class=\"rounded mx-auto d-block\">";
		}

		$this->view("frontend/berita_acara.php", $data);
	}

	function news() {
		$data['params'] = "?";
		foreach ($_GET as $key => $value) {
			if($key != "tags")
				$data['params'] .= "$key=$value&";
		}
		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['data'] = $this->get_berita_list();
		$data['jenis'] = 'berita';
		$data['hashtag'] = $this->get_hashtag_list();
		$data['model'] = $this->client;
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/news_event.php", $data);
	}

	function events() {
		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['data'] = $this->get_agenda_list();
		$data['jenis'] = 'agenda';
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/news_event.php", $data);
	}

	function visi_misi() {

		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/misc/visi_misi.php", $data);
	}

	function contact() {

		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/misc/contact.php", $data);
	}

	function departemen($departemen_id) {
		$departemen = $this->get_single_departement($departemen_id);

		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['departemen'] = $departemen;
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/departemen.php", $data);
	}

	function jurusan($jurusan_id) {
		$data['header']['jurusan'] = $this->susun_jurusan();
		$data['header']['theme'] = "dark";
		$data['jurusan'] = $this->get_single_jurusan($jurusan_id);
		$data['footer']['social'] = $this->get_social_links();

		$this->view("frontend/jurusan.php", $data);
	}

	function comment(){
		if(empty($_POST))
			die("not valid");

		$data = new stdClass();
		$data->berita_id = $_POST['berita_id'];
		$data->reply_to = isset($_POST['reply_to']) ? $_POST['reply_to'] : null;
		$data->nama = $_POST['name'];
		$data->email = $_POST['email'];
		$data->website = $_POST['web'];
		$data->comment = $_POST['comment'];

		// print_r($data);die;

		if($this->client->postComment($data)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	private function susun_jurusan(){
		
		$jurusan_mentahan = $this->client->getJurusan('departemen');
		$departemen = [];
		foreach ($jurusan_mentahan as $key => $value) {
			$departemen[$value->departement_id]['name'] = $value->departement_name;
			$departemen[$value->departement_id]['jurusan'] = $this->client->getJurusan('jurusan', $value->departement_id);
		}
		return $departemen;
	}

	private function recent_post() {
		$berita = $this->client->getBerita(3);
		
		return $berita;	

	}

	private function get_berita_data($id) {
		$berita = $this->client->getBeritaSatu($id);
		if(empty($berita)){
			http_response_code(404);die;
		}
		return $berita;
	}

	private function get_agenda_data($id) {
		$agenda = $this->client->getAgendaSatu($id);
		if(empty($agenda)){
			http_response_code(404);die;
		}
		
		return $agenda;
	}

	private function get_partner_logo() {
		$partner = $this->client->getPartner("logo");
		
		return $partner;
	}

	private function get_social_links() {
		$social = new stdClass();
		foreach ($this->client->getSocial() as $key => $value) {
			$platform = strtolower($value->sosmed_platform);
			$social->$platform = $value;
		}
		// print_r($social);die;
		return $social;
	}

	private function get_berita_list(){
		$page = getGet('page', 1);
		$filter_sort = getGet('sort');
		$filter_range = getGet('range');
		$tags = getGet('tags');

		switch ($filter_range) {
			case 'week':
				# populer mingguan
			$order_by = "view_count_week DESC, updated_at DESC";
			break;
			case 'month':
				# populer bulanan
			$order_by = "view_count_month DESC, updated_at DESC";
			break;
			case 'year':
				# populer tahunan
			$order_by = "view_count_year DESC, updated_at DESC";
			break;
			case 'all':
				# pokok populer
			$order_by = "view_count DESC, updated_at DESC";
			break;
			default:
				# terbaru
			$order_by = "updated_at DESC";
			break;
		}

		if(!empty($tags)) {
			$tag_array = explode(",", $tags);
			$tags = implode("','",$tag_array);
			$tags = "'$tags'";
		}

		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$filtered_content = $this->client->getBeritaBanyak($page, $order_by, $tags);

		$totalPage = (int) ceil(count($filtered_content) / 5);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$params = "";
		if(!empty($filter_sort) && !empty($filter_range)) {
			$params = "&sort=$filter_sort&range=$filter_range";
		} elseif(!empty($filter_sort)) {
			$params = "&sort=$filter_sort";
		}
		if(!empty($tags)) {
			$params .= "&tags=$tags";
		} 

		// BERITA SOURCES IS IN $filtered_content VARIABLE
		// FUNCS
		// FullDateFormat, convertToText, processing images

		// PAGINATION 
		
		$page_links = new stdClass();
		$page_links->prev = BASE_URL . "news?page=$previousPage$params";
		$page_links->base = BASE_URL . "news?page=$params";
		$page_links->next = BASE_URL . "news?page=$nextPage$params";

		$pagination = "";
		$begin_disabled = $isBeginPage ? "disabled" : "";
		if(!$isBeginPage)
			$pagination .= "<li><a href=\"$page_links->prev\" class=\"$begin_disabled\"><i class=\"fa fa-chevron-left\"></i></a></li>";

		for ($x = $page - $pageRange; $x < (($page + $pageRange) + 1); $x++) {
			if ($x > 0 && $x <= $totalPage) {
				$pagination .= $x == $page ? "<li><span>$x</span></li>" : "<li><a href=\"$page_links->base$x\">$x</a></li>";
			}
		}

		$last_disabled = $isLastPage ? "disabled" : "";
		if(!$isLastPage)
			$pagination .= "<li><a href=\"$page_links->next\"><i class=\"fa fa-chevron-right\"></i></a></li>";

		return ["ARRAY" => $filtered_content, "PAGINATION_HTML" => $pagination];
	}

	private function get_berita_list_tag($tag = ""){
		if(empty($tag)){
			http_response_code(404);die;
		}
		$page = getGet('page', 1);
		$filter_sort = getGet('sort');
		$filter_range = getGet('range');

		switch ($filter_range) {
			case 'week':
				# populer mingguan
			$order_by = "view_count_week DESC, updated_at DESC";
			break;
			case 'month':
				# populer bulanan
			$order_by = "view_count_month DESC, updated_at DESC";
			break;
			case 'year':
				# populer tahunan
			$order_by = "view_count_year DESC, updated_at DESC";
			break;
			case 'all':
				# pokok populer
			$order_by = "view_count DESC, updated_at DESC";
			break;
			default:
				# terbaru
			$order_by = "updated_at DESC";
			break;
		}

		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$filtered_content = $this->client->getBeritaBanyak($page, $order_by);

		$totalPage = (int) ceil(count($filtered_content) / 5);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		$params = "";
		if(!empty($filter_range) && !empty($filter_range)) {
			$params = "&sort=$filter_sort&range=$filter_range";
		}
		if(!empty($tags))
			$params .= "&tags=$filter_sort&range=$filter_range";

		// BERITA SOURCES IS IN $filtered_content VARIABLE
		// FUNCS
		// FullDateFormat, convertToText, processing images

		// PAGINATION 
		
		$page_links = new stdClass();
		$page_links->prev = BASE_URL . "news?page=$previousPage$params";
		$page_links->base = BASE_URL . "news?page=$params";
		$page_links->next = BASE_URL . "news?page=$nextPage$params";

		$pagination = "";
		$begin_disabled = $isBeginPage ? "disabled" : "";
		if(!$isBeginPage)
			$pagination .= "<li><a href=\"$page_links->prev\" class=\"$begin_disabled\"><i class=\"fa fa-chevron-left\"></i></a></li>";

		for ($x = $page - $pageRange; $x < (($page + $pageRange) + 1); $x++) {
			if ($x > 0 && $x <= $totalPage) {
				$pagination .= $x == $page ? "<li><span>$x</span></li>" : "<li><a href=\"$page_links->base$x\">$x</a></li>";
			}
		}

		$last_disabled = $isLastPage ? "disabled" : "";
		if(!$isLastPage)
			$pagination .= "<li><a href=\"$page_links->next\"><i class=\"fa fa-chevron-right\"></i></a></li>";

		return ["ARRAY" => $filtered_content, "PAGINATION_HTML" => $pagination];
	}

	private function get_hashtag_list($limit = FALSE){
		$hashtag = $this->client->getHashtag($limit);
		return $hashtag;
	}

	private function get_hashtag_post($id) {
		$hashtag = $this->client->getHashtag($id);
		return $hashtag;
	}

	private function get_related_post($tags, $current_id) {
		$tag_name = [];
		foreach ($tags as $key => $value){
			$tag_name[$key] = $value->hashtag_name;
		}
		$tag_name = implode("','",$tag_name);
		$tag_name = "'$tag_name'";
		$berita = $this->client->getBeritaRelated(3, $tag_name, $current_id);
		return $berita;
	}

	private function get_agenda_list(){
		$page = getGet('page', 1);

		$previousPage = $page - 1;
		$nextPage = $page + 1;
		$pageRange = 2;

		$filtered_content = $this->client->getAgendaBanyak($page);

		$totalPage = (int) ceil(count($filtered_content) / 5);
		$isBeginPage = $page == 1;
		$isLastPage = $page == $totalPage || $totalPage == 0;

		// BERITA SOURCES IS IN $filtered_content VARIABLE
		// FUNCS
		// FullDateFormat, convertToText, processing images

		// PAGINATION 
		$page_links = new stdClass();
		$page_links->prev = BASE_URL . "events?page=$previousPage";
		$page_links->base = BASE_URL . "events?page=";
		$page_links->next = BASE_URL . "events?page=$nextPage";

		$pagination = "";
		$begin_disabled = $isBeginPage ? "disabled" : "";
		if(!$isBeginPage)
			$pagination .= "<li><a href=\"$page_links->prev\" class=\"$begin_disabled\"><i class=\"fa fa-chevron-left\"></i></a></li>";

		for ($x = $page - $pageRange; $x < (($page + $pageRange) + 1); $x++) {
			if ($x > 0 && $x <= $totalPage) {
				$pagination .= $x == $page ? "<li><span>$x</span></li>" : "<li><a href=\"$page_links->base$x\">$x</a></li>";
			}
		}

		$last_disabled = $isLastPage ? "disabled" : "";
		if(!$isLastPage)
			$pagination .= "<li><a href=\"$page_links->next\"><i class=\"fa fa-chevron-right\"></i></a></li>";

		return ["ARRAY" => $filtered_content, "PAGINATION_HTML" => $pagination];
	}

	private function get_single_departement($id) {
		$departemen = $this->client->getSingleDepartement($id);
		if(empty($departemen)){
			http_response_code(404);die;
		}
		$result = new stdClass();
		$result->id = $departemen[0]->departement_id;
		$result->name = $departemen[0]->departement_name;
		$result->description = $departemen[0]->departement_description;
		$result->file = getImage(BASE_URL . $departemen[0]->file_directory, TRUE);
		$result->jurusan = $departemen;

		// die(print_r($result, TRUE));

		return $result;
	}

	private function get_single_jurusan($id) {
		$jurusan = $this->client->getSingleJurusan($id);
		if(empty($jurusan)){
			http_response_code(404);die;
		}
		$jurusan->image = getImage(BASE_URL . $jurusan->file, TRUE);
		return $jurusan;
	}
}

