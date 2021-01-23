<?php
session_start();

$titleAPP = "virtualna mjenjacnica v1.0.0";

$server = "localhost";
$dbName = "virtualna_mjenjacnica";
$userName = "root";
$password = "root";

$conn = new PDO("mysql:host=$server;dbname=$dbName", "$userName", "$password");
$conn->exec("set names utf8");

$flashPoruke = [
    1   => [
        'poruka' => 'Nisi unio obvezne parametre',
        'style'  => 'alert alert-danger'
    ],
    2   => [
        'poruka' => 'Email se već koristi',
        'style'  => 'alert alert-danger'
    ],
    3   => [
        'poruka' => 'Uspjesna registracija',
        'style'  => 'alert alert-success'
    ],
    4   => [
        'poruka' => 'Korisnik ne postoji ili lozinka nije ispravna',
        'style' => 'alert alert-danger'
    ],
    5   => [
        'poruka' => 'Uspjesna autorizacija',
        'style' => 'alert alert-success'
    ],
    6   => [
        'poruka' => 'Uspjesno se odjavljeni',
        'style' => 'alert alert-success'
    ],
    7   => [
        'poruka' => 'Id valute nije validan',
        'style' => 'alert alert-danger'
    ],
    8   => [
        'poruka' => 'Uspjesna operacija',
        'style' => 'alert alert-success'
    ],
    9   => [
        'poruka' => 'Zapis ne postoji',
        'style' => 'alert alert-danger'
    ]
]

?>