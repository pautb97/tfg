<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'tfg', 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") "
    . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";
$mysqli->set_charset("utf8");

$comptaPecesEntrant = $_POST['comptaPecesEntrant'];
$comptaPecesSortint = $_POST['comptaPecesSortint'];
$idESP = $_POST['idESP'];

$res = $mysqli->query("INSERT INTO `tfg`.`freques`(`id`, `created_at`, `updated_at`, `numero_peces`,`numero_peces_sortint`,`idESP`)VALUES(NULL,CURRENT_TIMESTAMP,NULL,$comptaPecesEntrant,$comptaPecesSortint,$idESP)");
echo "Missatge enviat";
?>

