<?php
session_start();
$usuari = $_POST['usuari'] ?? '';
$contrasenya = $_POST['contrasenya'] ?? '';

if ($usuari === $contrasenya && !empty($usuari)) {
    $_SESSION['usuari'] = $usuari;
    header("Location: pagina1.php");
    exit();
} else {
    header("Location: index.html");
    exit();
}
?>