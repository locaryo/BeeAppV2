<?php
class ErrorUrl extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function error404(){
        $this->view->render('404');
    }
}