<?php
$user = "root";
$password = "root";
$host = "localhost";
$dbname = "matricula_ifmg";

$connectionDb = mysqli_connect($host, $user, $password, $dbname);
if (!$connectionDb) {
    echo "<script>console.log('Falha ao conectar + ' " . mysqli_connect_error() . " )</script>";
} else {
    echo "<script>console.log('Sucesso ao conectar ' )</script>";
}
?>