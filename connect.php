<?php        
// Connexion à la BDD
$pdoBlog = new PDO(
   'mysql:host=localhost;dbname=blog',
   'root',
   '',
   array(
       PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
   )
);

// 2 - Ouverture de session

session_start();

// 3- chemin su site en constante
// Ici on définit le chemein absolu ds une constante, on écrira alors tous les chemins src et href avec cette constante // chez l'hébergeur la constante sera la suivante : definie('RACINE8SITE', '/');
define('RACINE_SITE', 'coursphp/correctionouedraogo.sq\modelisationBDD/');

// 4- variable contenu pr ls messages
// cette varible ne dt ps contenir d'espace
$contenu = "";

// 5- on inclus le fichier 
require_once 'inc/functions.inc.php';

