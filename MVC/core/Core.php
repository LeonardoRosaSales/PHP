<?php

class Core{
    public function run(){
        // echo "URL: " . $_GET['url'];
        $url = '/';

        if (isset($_GET['url'])) {
            // $url = $url . $_GET['url'];
            $url .= $_GET['url'];
        }

        // echo "URL: " . $url;

        $params = array();

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url); 

            $currentController = $url[0]. 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            }else {
                $currentAction = 'index';
            }

            if (count($url) > 0) {
                $params = $url;
            }
        }else {
            $currentController = 'homeController';
            $currentAction = 'index';
        }
        // echo 'CONTROLLER' . $currentController . '<br>';
        // echo 'ACTION' . $currentAction . '<br>';
        // echo 'PARAMS' . print_r($params, true) . '<br>';

        $c = new $currentController();

        call_user_func_array(array($c, $currentAction), $params);
    }
}