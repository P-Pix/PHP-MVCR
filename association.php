<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once("model/AssociationStorageMySQL.php");
require_once('/users/22007629/private/mysql_config.php');

/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */

const USER = MYSQL_USER;
const SERVER = "mysql:host=" . MYSQL_HOST .";port=" . MYSQL_PORT . ";dbname=" . MYSQL_DB . ";charset=utf8mb4";
const PASSWORD = MYSQL_PASSWORD;

$router = new Router(new AssociationStorageMySQL(new PDO(SERVER, USER, PASSWORD)));
$router->main();
?>