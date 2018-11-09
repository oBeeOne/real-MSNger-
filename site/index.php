<?php

/*http://php.net/manual/fr/yaf.tutorials.php*/

// Gestion des erreurs complete pour debugage, à désactiver absolument pour la production

ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors',1);
ini_set('display_errors',1);

// Initialisation des chemins de fichiers
defined('BASE_PATH') || define('BASE_PATH', realpath(__DIR__)."/");
set_include_path(get_include_path().":".BASE_PATH."include:".BASE_PATH."conf:".BASE_PATH."theme");

// Chargement de l'autoloader de fichiers
require_once('autoload.php');

// Définitions des fichiers nécessaires (sans extension)
$files = array("db", "session", "auth", "chat");

// Autoload des fichiers via l'autoloader
autoload($files);

// Parse du fichier de config pour récupérer les identifiants de la BDD
$parse = parse_ini_file('conf.ini', true);

// Connexion à la BDD /!\ $db est un objet PDO et non une variable /!\
$db = db_connect($parse);


?>


