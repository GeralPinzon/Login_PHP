<?php
$server = 'localhost';
$port = '3306';
$username = 'root';
$password = 'AppEnd_mysql';
$database = 'AppEndBot';
$server_host = $server . ":" . $port;

try {
    $conexionPDO = new PDO("mysql:host=$server_host;dbname=$database;", $username, $password);
    $conexionMySQLi = mysqli_connect($server, $username, $password, $database, $port);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage() . ' →' . mysqli_error());
}
?>