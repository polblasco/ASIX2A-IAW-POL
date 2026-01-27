<?php
require_once "../config/auth_check.php";
require_once "../config/config.php";

$search = esc($conn, $_GET["search"] ?? "");

$sql = "SELECT e.*, u.name AS creator
        FROM events e
        JOIN users u ON e.created_by = u.id
        WHERE 1";

if ($search !== "") {
    $like = "%$search%";
    $sql .= " AND (e.title LIKE '$like' OR e.location LIKE '$like')";
}

$sql .= " ORDER BY e.event_date ASC";

$result = mysqli_query($conn, $sql);
?>

<?php include "../includes/header.php"; ?>

<h2>Llista d'events</h2>

<form method="get">
    <input type="text" name="search" placeholder="Cerca per nom o lloc" value="<?php echo $search; ?>">
    <button type="submit">Cercar</button>
</form>

<?php if ($_SESSION["user_role"] === "organitzador"): ?>
    <p><a href="event_create.php">Crear nou event</a></p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>Títol</th>
        <th>Descripció</th>
        <th>Lloc</th>
        <th>Data</th>
        <th>Preu</th>
        <th>Creador</th>
        <th>Accions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row["title"]; ?></td>
        <td><?php echo $row["description"]; ?></td>
        <td><?php echo $row["location"]; ?></td>
        <td><?php echo $row["event_date"]; ?></td>
        <td><?php echo $row["price"]; ?> €</td>
        <td><?php echo $row["creator"]; ?></td>
        <td>
            <?php if ($_SESSION["user_role"] === "organitzador" && $row["created_by"] == $_SESSION["user_id"]): ?>
                <a href="event_edit.php?id=<?php echo $row["id"]; ?>">Editar</a>
                <a href="event_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Segur que vols eliminar aquest event?');">Eliminar</a>
            <?php endif; ?>

            <a href="../registrations/registration_create.php?event_id=<?php echo $row["id"]; ?>">Inscriure'm</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>