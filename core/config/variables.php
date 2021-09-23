<?php
// CHANGE THIS IF THE ADDRESS HAS BEEN CHANGED
$base = $_SERVER['SERVER_NAME'];

// THIS IS BASE PATH YOUR WEB
// IF PATH is EMPTY
// $root_path = "/";
$root_path = "/smkpgri3/";


// THIS IS HTTP NON-SECURE OR SECURE (http / https)
$HTTP = "http://";

//
// WARNING!!!
//
// DON'T CHANGE THIS DECLARATION UNLESS YOU WILL DEVELOP SYSTEM CORE
$from = '/'.preg_quote($root_path, '/').'/';
$uri = preg_replace($from, '', strtok($_SERVER['REQUEST_URI'], '?'), 1);
define("ROOT_PATH", $root_path);
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . $root_path);
define("BASE_URL", "$HTTP$base$root_path");
define("URI_STRING", $uri);
define("ASSETS_URL", BASE_URL . "public/");
