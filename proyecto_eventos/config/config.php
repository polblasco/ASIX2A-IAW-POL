<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'proyecto_eventos';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de connexió a la base de dades: " . mysqli_connect_error());
}

function esc($conn, $str) {
    return mysqli_real_escape_string($conn, trim($str));
}
?>