<?php

class App {

    private $config = [];

    public $db;

    function __construct () {
        // print_r($_SERVER);die;
        require "config/variables.php";
        require "config/autoload.php";

        foreach ($autoload_helper as $file_name){
            require ROOT . '/core/helpers/' . $file_name . '.php';
        }
    }

    function autoload () {

        spl_autoload_register(function ($class) {
            $class = strtolower($class);
            if (file_exists(ROOT . '/core/classes/' . $class . '.php')) {

                require_once ROOT . '/core/classes/' . $class . '.php';

            } else if (file_exists(ROOT . '/core/helpers/' . $class . '.php')) {

                require_once ROOT . '/core/helpers/' . $class . '.php';

            }

        });

    }

    function config () {

        $this->require('/core/config/session.php');
        $this->require('/core/config/database.php');

        try {

            $this->db = new PDO('mysql:host=' . $this->config['database']['hostname'] . ';dbname=' . $this->config['database']['dbname'],
                $this->config['database']['username'], 
                $this->config['database']['password']);
            $this->db->query('SET NAMES utf8');
            // $this->db->query('SET CHARACTER_SET utf8_unicode_ci');
            
            // TODO: Remove for production
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }

    function require ($path) {

        require ROOT . $path;

    }

    function start () {

        session_name($this->config['sessionName']);
        session_start();
        $route = explode('/', URI_STRING);
        require ROOT . '/core/config/routes.php';
        $uri= "";
        $finalized_uri;
        $params = [];
        $param_starts = NULL;
        for($x = 0; isset($route[$x]); $x++) {
            $xx = $x + 1;
            $uri .= $x == 0 ? $route[$x] : '/'.$route[$x] ;
            if(isset($routes[$uri])) {
                $finalized_uri = $uri;
                $param_starts = $xx;
            }
            if($x >= $param_starts) {
                $params[] = $route[$x];
            }
        }
        if(!isset($finalized_uri)){
            http_response_code(404);die;
        }
        $replaced_route = explode('/', $routes[$finalized_uri]);
        foreach ($params as $key => $value) {
            array_push($replaced_route, $value);
        }

        if (file_exists(ROOT . '/app/controllers/' . $replaced_route[0] . '.php')) {
            $this->require('app/controllers/' . $replaced_route[0] . '.php');
            $controller = new $replaced_route[0]();
        } elseif (empty($replaced_route)) {
            $this->require('app/controllers/admin.php');
            $admin = new Admin();
        } else {
            $this->require('app/controllers/admin.php');
            http_response_code(404);
        }

    }
    
}

?>