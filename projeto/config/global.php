<?php
date_default_timezone_set('America/Sao_Paulo');

define('BASE', 'http://localhost');
define('ASSET', '/public/');

/* define('ACTUAL_LINK', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); */

/**DATABASE CREDENCIAIS**/
define('DB_HOST', "mysql"); //Por estar utilizando docker a conexão só foi possível usando host como "mysql"
define('DB_USER', "admin");
define('DB_PASS', "admin");
define('DB_NAME', "prova");
define('DB_PORT', 3306);

/** API KEY E ALGORITMO USADO PARA ENCODE E DECODE */
define('SECRET', "teste");
define('ALGORITHM', 'HS512');
