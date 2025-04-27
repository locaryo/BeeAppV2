<?php
// config/config.php

if (!defined('__baseurl__')) {
    define('__baseurl__', 'http://192.168.0.186/beeappV2/');
}
if (!defined('__layout__')) {
    define('__layout__', 'views/layouts/');
}
if (!defined('TITLE')) {
    define('TITLE', 'BeeApp');
}
if (!defined('HOST')) {
    define('HOST', '192.168.0.186');
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

// Define los arrays de días, horas, secciones, niveles y materias
$horas = [
    "8:00 - 8:50",
    "9:00 - 9:50",
    "10:00 - 10:50",
    "11:00 - 11:50",
    "12:00 - 12:50",
    "13:00 - 13:50",
    "14:00 - 14:50",
    "15:00 - 15:50",
    "16:00 - 16:50",
    "17:00 - 17:50"
];
$dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];
$secciones = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];
$niveles = ["1°ero", "2°do", "3°ero", "4°to", "5°to", "6°to", "7°mo", "8°vo", "9°no", "10°mo", "11°vo", "12°vo"];
$materias = ["Matematicas", "Lengua", "Ciencias", "Historia", "Geografia", "Educacion Fisica", "Arte", "Musica", "Ingles", "Tecnologia"];
$menciones = ["Petroquímica", "Mecánica", "Electricidad", "Electrónica", "Construcción", "Mantenimiento", "Sistemas", "Programación"];
