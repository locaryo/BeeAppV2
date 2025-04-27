<?php

class App{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url']:null;
        $url = rtrim($url,'/');
        $url = explode('/', $url);
        
        if(empty($url[0])){
            $archivoController = "controllers/home.php";
            require_once $archivoController;
            $controller = new Home();
            $controller->index();
            $controller->loadModel('home');
            return false;
        }elseif(count($url) <= 2 && empty($url[1])){
            $archivoController = "controllers/error.php" ;
            require_once $archivoController;
            $controller = new ErrorUrl();
            $controller->error404();
            return false;
        }

        $archivoController = "controllers/" . $url[0] . ".php";

        if(file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            if (isset($url[1])) {
                $controller->{$url[1]}();
            }
        }else{
            require_once "controllers/error.php";
            $controller = new ErrorUrl();
            $controller->error404();
        }
    }
}

?>