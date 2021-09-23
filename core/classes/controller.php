<?php

abstract class Controller {

    private $route = [];

    private $args = 0;

    private $params = [];

    function __construct () {

        $this->route = explode('/', URI_STRING);
        require ROOT . '/core/config/routes.php';
        $uri= "";
        $finalized_uri;
        $params = [];
        $param_starts = NULL;
        for($x = 0; isset($this->route[$x]); $x++) {
            $xx = $x + 1;
            $uri .= $x == 0 ? $this->route[$x] : '/'.$this->route[$x] ;
            if(isset($routes[$uri])) {
                $finalized_uri = $uri;
                $param_starts = $xx;
            }
            if($x >= $param_starts) {
                $params[] = $this->route[$x];
            }
        }
        if(!isset($finalized_uri)){
            http_response_code(404);die;
        }
        $replaced_route = explode('/', $routes[$finalized_uri]);
        foreach ($params as $key => $value) {
            array_push($replaced_route, $value);
        }
        $this->route = $replaced_route;
        $this->route[0] = strtolower($this->route[0]);

        $this->args = count($this->route);
        $this->router();
    }

    private function router () {
        // die($this->args >= 2);
        // die(class_exists($this->route[0]));
        
        // condition if class exists
        if (class_exists($this->route[0])) {

            // If uri calls with function/method
            if ($this->args >= 2) {

                if (method_exists($this, $this->route[1])) {
                    $this->uriCaller(1, 2);
                } else {
                    $this->uriCaller(0, 1);
                }
            } else {
                $this->uriCaller(0, 1);
            }

        } else { // only call class name

            if ($this->args >= 1) {
                if (method_exists($this, $this->route[0])) {
                    $this->uriCaller(1, 2);
                } else {
                    $this->uriCaller(0, 1);
                }
            } else {
                $this->uriCaller(0, 1);
            }

        }

    }

    private function uriCaller ($method, $param) {

        for ($i = $param; $i < $this->args; $i++) {
            $this->params[$i] = $this->route[$i];
        }

        if ($method == 0)
            call_user_func_array(array($this, 'Index'), $this->params);
        else
            call_user_func_array(array($this, $this->route[$method]), $this->params);

    }

    abstract function Index ();

    function model ($path, $name = '') {

        $path = $path;

        $class = explode('/', $path);
        $class = $class[count($class)-1];

        $path = strtolower($path);

        require(ROOT . '/app/models/' . $path . '.php');
        if(empty($name)){
            $this->$class = new $class;    
        } else {
            $this->$name = new $class;
        }
        

    }

    function view ($path, $data = [], $return = FALSE) {

        if (is_array($data))
            extract($data);

        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file = ($ext === '') ? "$path.php" : $path;

        if($return)
            return file_get_contents(ROOT . 'app/views/' . $file);
        require(ROOT . 'app/views/' . $file);

    }

    function library($path, $name = '' ) {
        $path = $path;

        $class = explode('/', $path);
        $class = $class[count($class)-1];

        $path = strtolower($path);

        require(ROOT . '/core/libraries/' . $path . '.php');
        if(empty($name)){
            $this->$class = new $class;
        } else {
            $this->$name = new $class;
        }
    }

}

?>