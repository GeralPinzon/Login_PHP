<?php
$server = 'localhost';
$port = '3306';
$username = 'root';
$password = 'AppEnd_mysql';
$database = 'AppEndBot';

try {
    //$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    $conn = mysqli_connect($server, $username, $password, $database, $port);
} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage(). ' →'.mysqli_error());
}
?>