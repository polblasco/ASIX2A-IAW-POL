<?php
require_once "../config/auth_check.php";
require_once "../config/config.php";

$id = (int)($_GET["id"] ?? 0);

$sql = "SELECT * FROM registrations WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id, $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$reg = mysqli_fetch_assoc($result);

if (!$reg) {
    header("Location: ../config/error.php?msg=No tens permís per cancel·lar aquesta inscripció");
    exit;
}

$sql = "DELETE FROM registrations WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: registrations_list.php");
exit;