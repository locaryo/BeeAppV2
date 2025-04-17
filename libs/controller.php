<?php

class Controller{
    public $view;
    public $model;
    public $pdf;
    public $excel;
    public $writeExcel;
    function __construct()
    {
        $this->view = new View();
        $this->pdf = new FPDF();
    }

    function loadModel($name){
        $url = 'model/'.$name.'Model.php';

        if(file_exists($url)){
            require $url;
            $modelname = $name.'Model';
            $this->model = new $modelname();
        }else{
            echo "libs/controller, line:23";
        }
    }
}