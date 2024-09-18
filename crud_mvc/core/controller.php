<?php
class controller{
    //Responsável em mostrar o que estiver na pasta VIEW
    public function loadView($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }

    //Trazer os arquivos da view (menu.php)
    public function loadTemplate($viewName, $viewData = array()){
        require 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
}