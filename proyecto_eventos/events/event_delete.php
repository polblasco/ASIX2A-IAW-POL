<?php
require_once "../config/auth_check.php";
require_once "../config/config.php";

$id = (int)($_GET["id"] ?? 0);

$sql = "SELECT * FROM events WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event || $event["created_by"] != $_SESSION["user_id"]) {
    header("Location: ../config/error.php?msg=No tens permís per eliminar aquest event");
    exit;
}

$sql = "SELECT COUNT(*) AS total FROM registrations WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row["total"] > 0) {
    header("Location: ../config/error.php?msg=No es pot eliminar un event amb inscripcions associades");
    exit;
}

$sql = "DELETE FROM events WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: events_list.php");
exit;