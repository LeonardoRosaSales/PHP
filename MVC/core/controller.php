<?php
class controller{
    public function loadView($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }

    // trazer os arquivos da view (menu.php)
    public function loadTemplate($viewName, $viewData = array()){
        require 'view/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
}