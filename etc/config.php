<?php
session_start();

$titleAPP = "virtualna mjenjacnica v1.0.0";

$server = "localhost";
$dbName = "virtualna_mjenjacnica";
$userName = "root";
$password = "root";

$conn = new PDO("mysql:host=$server;dbname=$dbName", "$userName", "$password");

$conn->exec("set names utf8");
?>