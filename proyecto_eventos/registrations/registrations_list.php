<?php
require_once "../config/auth_check.php";
require_once "../config/config.php";

$filter_status = esc($conn, $_GET["status"] ?? "");

if ($_SESSION["user_role"] === "organitzador") {
    $sql = "SELECT r.*, u.name AS user_name, e.title AS event_title
            FROM registrations r
            JOIN users u ON r.user_id = u.id
            JOIN events e ON r.event_id = e.id
            WHERE 1";
} else {
    $uid = $_SESSION["user_id"];
    $sql = "SELECT r.*, u.name AS user_name, e.title AS event_title
            FROM registrations r
            JOIN users u ON r.user_id = u.id
            JOIN events e ON r.event_id = e.id
            WHERE r.user_id = $uid";
}

if ($filter_status !== "") {
    $sql .= " AND r.status = '$filter_status'";
}

$sql .= " ORDER BY r.registered_at DESC";

$result = mysqli_query($conn, $sql);
?>

<?php include "../includes/header.php"; ?>

<h2>Inscripcions</h2>

<form method="get">
    <label>Filtrar per estat:
        <select name="status">
            <option value="">Tots</option>
            <option value="pendent" <?php if ($filter_status==='pendent') echo 'selected'; ?>>Pendent</option>
            <option value="confirmada" <?php if ($filter_status==='confirmada') echo 'selected'; ?>>Confirmada</option>
            <option value="cancel·lada" <?php if ($filter_status==='cancel·lada') echo 'selected'; ?>>Cancel·lada</option>
        </select>
    </label>
    <button type="submit">Filtrar</button>
</form>

<table border="1">
    <tr>
        <th>Usuari</th>
        <th>Event</th>
        <th>Estat</th>
        <th>Data inscripció</th>
        <th>Accions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row["user_name"]; ?></td>
        <td><?php echo $row["event_title"]; ?></td>
        <td><?php echo $row["status"]; ?></td>
        <td><?php echo $row["registered_at"]; ?></td>
        <td>
            <?php if ($_SESSION["user_role"] !== "organitzador" && $row["user_id"] == $_SESSION["user_id"]): ?>
                <a href="registration_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Cancel·lar inscripció?');">Cancel·lar</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>