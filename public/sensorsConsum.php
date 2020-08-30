<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'tfg', 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";
$mysqli->set_charset("utf8");

$R = $_POST['IRrms'];
$S = $_POST['ISrms'];
$T = $_POST['ITrms'];
$POT = $_POST['Paparent'];
$idESP = $_POST['idESP'];

$res = $mysqli->query("INSERT INTO `tfg`.`consums` (`id`, `created_at`, `updated_at`, `intensitat_R`,`intensitat_S`,`intensitat_T`,`potencia`,`id_ESP`) VALUES (NULL,CURRENT_TIMESTAMP,NULL,$R,$S,$T,$POT,$idESP)");
echo "Missatge enviat";
?>
