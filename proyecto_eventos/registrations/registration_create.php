<?php
require_once "../config/auth_check.php";
require_once "../config/config.php";

$event_id = (int)($_GET["event_id"] ?? 0);

$sql = "SELECT * FROM events WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    header("Location: ../config/error.php?msg=Event no trobat");
    exit;
}

$sql = "SELECT id FROM registrations WHERE user_id = ? AND event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $_SESSION["user_id"], $event_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    header("Location: ../config/error.php?msg=Ja estàs inscrit en aquest event");
    exit;
}

$sql = "INSERT INTO registrations (user_id, event_id, status) VALUES (?, ?, 'pendent')";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $_SESSION["user_id"], $event_id);
mysqli_stmt_execute($stmt);

header("Location: registrations_list.php");
exit;