<?php

echo "hola";
$mysqli = new mysqli('127.0.0.1', 'root', '', 'tfg');
$mysqli->set_charset("utf8");

$comptaPeces = $_POST ['comptaPeces'];

$res = $mysqli->query("INSERT INTO `tfg`.`freques` (`id`, `created_at`, `updated_at`, `numero_peces`) VALUES (NULL, CURRENT_TIMESTAMP , NULL , '$comptaPeces');");

echo "Dades ingressades correctament";
?>
