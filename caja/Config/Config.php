<?php

const BASE_URL = 'http://localhost/mdesv/caja/';
define('URL_BIBLIOTECA', 'http://localhost/mdesv/caja/');

$path = dirname(dirname(__FILE__));

define("PATH_DIR", $path . '/');
define("PATH_CONTROLLERS", PATH_DIR . 'Controllers/');
define("PATH_LIBRARIES", PATH_DIR . 'Libraries/');
define("PATH_MODELS", PATH_DIR . 'Models/');
define("PATH_VIEW", PATH_DIR . 'Views/');

define("TIME_SESSION", array('horas' => 2, 'minutos' => 0));

define("PATH_FOTOPERFIL", 'C:/laragon/www/mdesv/caja/Assets/images/fotoperfil/');
define("PATH_FOTOAUTOR", 'C:/laragon/www/mdesv/caja/Assets/images/autores/');
define("PATH_FOTOLIBRO", 'C:/laragon/www/mdesv/caja/Assets/images/libros/');

date_default_timezone_set('America/Lima');

const DB_CAJA = 'mdesv_caja';

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const SB_CHARSET ='charset=utf8';

define("VER_MEDIA", "1.0.0.0");