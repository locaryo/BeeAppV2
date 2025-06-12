<?php

class View
{

    public function __construct()
    {
        //
    }
    public function render($view, $data = [])
    {
        extract($data);
        require "views/$view.php";
    }

    public function renderFull($view, $data = [])
    {
        extract($data);
        if ($this->isAjaxRequest()) {
            // Para peticiones AJAX, solo devolvemos el contenido principal
            ob_start();
            require "views/$view.php";
            $content = ob_get_clean();
            echo $content;
        } else {
            // Para peticiones normales, renderizamos la página completa
            require constant("__layout__") . "header.php";
            require constant("__layout__") . "nav.php";
            require constant("__layout__") . "aside.php";
            
            echo '<main id="main-content" class="main-content position-relative border-radius-lg fade-content">';
            require "views/$view.php";
            echo '</main>';

            require constant("__layout__") . "footer.php";
            require constant("__layout__") . "scripts.php";
        }
    }

    private function isAjaxRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
