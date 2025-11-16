<?php
session_start();

if (!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = ["terrasses" => 0, "raventos" => 0];
}

if (isset($_POST['terrasses'])) {
    $_SESSION['cistella']['terrasses'] += (int)$_POST['terrasses'];
}
if (isset($_POST['raventos'])) {
    $_SESSION['cistella']['raventos'] += (int)$_POST['raventos'];
}

header("Location: index.html");
exit();
?>