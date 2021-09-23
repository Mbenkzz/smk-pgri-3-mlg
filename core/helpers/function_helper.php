<?php

function MinifyHTML($string) {
    $Minify = $string;
    // $Minify = str_replace("\n","",$Minify);
    // $Minify = str_replace("\t","",$Minify);
    // $Minify = preg_replace('/\s+/S', " ", $Minify);
    // $Minify = str_replace("> <","><",$Minify);
    // $Minify = str_replace(" : ", ":", $Minify);
    // $Minify = str_replace(" == ", "==", $Minify);
    return $Minify;
}

function convertToColumn($item) {

    $pot1 = strpos($item, ".");
    $length1 = strlen($item);

    if($pot1 > 0) {
        $item = substr($item, $pot1 + 1, $length1);
    }

    $pot2 = strpos($item, " AS ");
    $length2 = strlen($item);

    if($pot2 > 0) {
        $item = substr($item, $pot2, $length2);
    }

    return $item;
}

function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

function dateFormat2($date){return date('F Y', strtotime($date));}

function encrypt($id) { 
    $id = str_replace("/", "|", $id);
    return str_replace("|","%7C", $id);
}

function decrypt($id) {
    $id = urldecode($id);
    return str_replace("|", "/", $id);
}

function url($param) {
    return BASE_URL . $param;
}

function removePrevix($param) {
    return substr($param, 0, strpos($param, "_"));
}

function getCurrentDate($format = 'Y-m-d H:i:s') {
    date_default_timezone_set("Asia/Jakarta");
    return date($format);
}

function getGet($index, $default = "") {
    if(isset($_GET[$index])) {
        if(!empty($_GET[$index])) {
            return $_GET[$index];
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}

function getPost($index, $default = "") {
    if(isset($_POST[$index])) {
        if(!empty($_POST[$index])) {
            return $_POST[$index];
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}

function getRequest($index, $default = null) {
    if(isset($_REQUEST[$index])) {
        if(!empty($_REQUEST[$index])) {
            return $_REQUEST[$index];
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}

function check_log ($that, $role_set = TRUE) {
    $role = getRoleList();
    $section = isset(explode('/', URI_STRING)[1]) ? explode('/', URI_STRING)[1] : "";
    switch ($section) {
        case 'berita':
        $page = "BERITA";
        break;
        case 'agenda':
        $page = "AGENDA";
        break;
        default:
        $page = "OTHER";
        break;
    }
    // echo $_SESSION["role"];
    // print_r($role[$_SESSION['role']]->AKSES);die;

    if(!isset($_SESSION['username'])) {
        # SESI HABIS
        $that->view("login");die;
    } elseif (!in_array($page, $role[$_SESSION['role']]->AKSES) && $role_set) {
        # AKSES DITOLAK
        http_response_code(403);die;
    }
}

function isAuthorized($page){
    $page = strtoupper($page);
    $role = getRoleList();
    if($page != "BERITA" && $page != "AGENDA")
        $page = "OTHER";
    if (!in_array($page, $role[$_SESSION['role']]->AKSES))
        return false;
    return true;
}

function redirect($path) {
    header("Location: ".BASE_URL.$path);
}

function getSessionUser($that, $column = NULL) {
    if(isset($_SESSION['username'])) {
        $that->model("Model_Users", "user");
        $row = $that->user->getFilteredData($_SESSION['username']);
        // print_r($row);die;
        if($row) {
            if ($column)
                return $row[0]->$column;
            return $row[0];
        } else {
            $_SESSION['username'];
        }
    } else {
        die(json_response("GAGAL", "Sesi anda telah habis, silahkan login ulang dengan menekan logout"));
    }
}

function get_user_data($that, $id) {
    $that->model("Model_Users", "user");
    return $that->user->getSingleData($id);
}

function json_response($result = "OK", $response) {
    return json_encode(["RESULT" => $result, "DATA" => $response]);
}

function alertSuccess($param) {
    return "<div class=\"alert alert-success\" role=\"alert\">" . $param . "</div>";
}

function alertGagal($param) {
    return "<div class=\"alert alert-danger\" role=\"alert\">" . $param . "</div>";
}

function alertWarning($param) {
    return "<div class=\"alert alert-warning\" role=\"alert\">" . $param . "</div>";
}

function isSelected($key, $value) {
    return ($key == $value) ? 'selected' : '';
}

function isChecked($key, $value) {
    return ($key == $value) ? 'checked' : '';
}

function isActive($key, $value) {
    return ($key == $value) ? 'active' : '';
}

function isReadonly($key, $value = 1) {
    return ($key == $value) ? 'readonly' : '';
}

function DateFormat($date,$format='') {

    date_default_timezone_set("Asia/Jakarta");
    if($format==''){
        $format = 'd/m/Y';
    }

    $date   = str_replace("/", "-", $date);

    return date($format, strtotime($date));
}

function DateTimeFormat($date,$format = 'd/m/Y H:i:s') {
    date_default_timezone_set("Asia/Jakarta");
    $date = str_replace("/","-",$date);
    return date($format, strtotime($date));
}

function dateFormat1($date) {
    return date('d M Y', strtotime($date));
}

function json_respons_ok($msg) {
    $var = JSONResponse(array(
        'RESULT' => 'OK',
        'DATA' => $msg
    ));
}

function json_respons_error($msg) {
    $var = JSONResponse(array(
        'RESULT' => 'ERROR',
        'DATA' => $msg
    ));
}

function ExtendsDate($date, $format, $extends) {

    if($extends > 0) {
        $day     = sprintf("+$extends day");
        $time    = strtotime($day, strtotime($date));
    } else {
        $time   = strtotime($date);
    }

    $monthFunc = array(
        "Jan" => "January",
        "Feb" => "Febuari",
        "Mar" => "Maret",
        "Apr" => "April",
        "May" => "Mei",
        "Jun" => "Juni",
        "Jul" => "Juli",
        "Aug" => "Agustus",
        "Sep" => "September",
        "Oct" => "Oktober",
        "Nov" => "November",
        "Dec" => "Desember"
    );

    $dayFunc    = array(
        "Sun" => "Minggu",
        "Mon" => "Senin",
        "Tue" => "Selasa",
        "Wed" => "Rabu",
        "Thu" => "Kamis",
        "Fri" => "Jumat",
        "Sat" => "Sabtu"
    );

    $d  = date('d',$time);
    $D  = date('D',$time);
    $Dn = $dayFunc[$D];
    $m  = date('m',$time);
    $M  = date('M',$time);
    $Mn = $monthFunc[$M];
    $y  = date('y',$time);
    $Y  = date('Y',$time);

    switch ($format) {
        case 'Dn, d Mn Y':
        return "$Dn, $d $Mn $Y";
        break;
        
        case 'Y-m-d':
        return "$Y-$m-$d";
        break;

        case 'd/m/Y' :
        return "$d/$m/$Y";
        break;

        default:
        return "Unknow Format";
        break;
    }
}

function FullDateFormat($date, $format = "d M Y", $pemisah = " ") {

    $monthFunc = array(
        "Jan" => "January",
        "Feb" => "Februari",
        "Mar" => "Maret",
        "Apr" => "April",
        "Mei" => "Mei",
        "Jun" => "Juni",
        "Jul" => "Juli",
        "Aug" => "Agustus",
        "Sep" => "September",
        "Oct" => "Oktober",
        "Nov" => "November",
        "Dec" => "Desember"
    );

    $dayFunc    = array(
        "Sun" => "Minggu",
        "Mon" => "Senin",
        "Tue" => "Selasa",
        "Wed" => "Rabu",
        "Thu" => "Kamis",
        "Fri" => "Jumat",
        "Sat" => "Sabtu"
    );

    $time   = strtotime($date);
    $date = date('d', $time);
    $month = $monthFunc[date('M', $time)];
    $year = date('Y', $time);

    $H      = date('H',$time);
    $h      = date('h', $time);
    $I    = date('I', $time);
    $i    = date('i', $time);
    $S     = date('S', $time);
    $s     = date('s', $time);

    $return = "";

    switch ($format) {
        case 'd M Y':

        $return = $date . $pemisah . $month . $pemisah . $year;
        break;

        case 'd M Y H:i:s':
        $return = $date . $pemisah . $month . $pemisah . $year . ' ' . $H . ':' . $i . ':' . $s;
        break;

        case 'd M Y H:i':
        $return = $date . $pemisah . $month . $pemisah . $year . ' ' . $H . ':' . $i;
        break;

        case 'M Y':
        $return = $month . $pemisah . $year;
        break;

        default:
        $return = "Format Tidak Diketahui";
        break;
    }

    return $return;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'pekan',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            // $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
}

function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x < 12) {
        $temp = " " . $angka[$x];
    } else if ($x < 20) {
        $temp = kekata($x - 10) . " belas";
    } else if ($x < 100) {
        $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
    } else if ($x < 200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x < 1000) {
        $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
    } else if ($x < 2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x < 1000000) {
        $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
    } else if ($x < 1000000000) {
        $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
    } else if ($x < 1000000000000) {
        $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
    } else if ($x < 1000000000000000) {
        $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
    }
    return $temp;
}

function terbilang($x, $style = 4) {
    if ($x < 0) {
        $hasil = "minus " . trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }
    switch ($style) {
        case 1:
        $hasil = strtoupper($hasil);
        break;
        case 2:
        $hasil = strtolower($hasil);
        break;
        case 3:
        $hasil = ucwords($hasil);
        break;
        default:
        $hasil = ucfirst($hasil);
        break;
    }
    return $hasil;
}

function replaceNull($text, $replace = "") {
    $text = str_replace("\n","",$text);
    return str_replace("null",$replace,$text);
}

function getLabel($aktif = 0, $id = "false") {
    $result = "danger";
    $label = "nonaktif";
    $boolean = "1";
    if($aktif) {
        $result = "success";
        $label = "aktif";
        $boolean = "0";
    }
    return "<button type=\"button\" title=\"klik untuk mengubah status\" class=\"btn btn-sm btn-$result toggle\" onclick=\"typeof toggleActive == 'function' ? toggleActive($id, $boolean) : false;\">$label</button>";
}

function convertToText($string, $chars = FALSE) {
    $string = trim(strip_tags($string));
    if ($chars) {
        if(strlen($string) > $chars)
            $string = substr($string, 0, $chars) . "...";
        else
            $string = substr($string, 0, $chars);
    }
    return $string;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getRoleList() {
    $array = json_decode(file_get_contents(ASSETS_URL.'json/role.json'));
    $array_final = [];
    // REBUILD TO BE FRIENDLY ASSOCIATIVE ARRAY
    foreach ($array as $value) {
        $array_final[$value->ROLE] = new stdClass();
        $array_final[$value->ROLE]->ROLE = $value->ROLE;
        $array_final[$value->ROLE]->ROLE_NAME = $value->ROLE_NAME;
        $array_final[$value->ROLE]->AKSES = $value->AKSES;
    }

    return $array_final;
}

function getImage($url, $blank = FALSE) {
    $file_headers = @get_headers($url);
    // print_r($url);die;
    $isnt_image = (strpos($file_headers[8], 'Content-Type: image') === FALSE);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' || $isnt_image) {
        if($blank)
            return FALSE;
        else     
            return ASSETS_URL ."/images/no-image.jpg";
    }
    else {
        return $url;
    }
}

function isApprove($that, $id) {
    $that->model("model_berita", "berita");
    $berita = $that->berita->getSingleData($id);
    if(empty($berita))
        return FALSE;
    return $berita->isapprove;
}

function getRepliedComment($var_model, $id) {
    $comment = $var_model->getSingleComment($id);
    return $comment;
}

function getComment($var_model, $id) {
    $comment = $var_model->getComment($id);
    return $comment;
}

?>
