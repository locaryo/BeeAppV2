<?php
// config/config.php

if (!defined('__baseurl__')) {
    // define('__baseurl__', 'http://localhost/beeapp/'); 
    define('__baseurl__', 'http://192.168.0.109/beeapp/');
}
if (!defined('__layout__')) {
    define('__layout__', 'views/layouts/');
}
if (!defined('TITLE')) {
    define('TITLE', 'BeeApp');
}
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('DB')) {
    define('DB', 'beeapp_ali');
}
if (!defined('USER')) {
    define('USER', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}