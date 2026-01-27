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
    header("Location: ../config/error.php?msg=No tens permís per editar aquest event");
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = esc($conn, $_POST["title"]);
    $description = esc($conn, $_POST["description"]);
    $location = esc($conn, $_POST["location"]);
    $event_date = esc($conn, $_POST["event_date"]);
    $price = esc($conn, $_POST["price"]);

    if ($title === "" || $event_date === "") {
        $errors[] = "Títol i data són obligatoris.";
    }

    if (empty($errors)) {
        $sql = "UPDATE events
                SET title = ?, description = ?, location = ?, event_date = ?, price = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdi",
            $title, $description, $location, $event_date, $price, $id
        );
        mysqli_stmt_execute($stmt);

        header("Location: events_list.php");
        exit;
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2>Editar event</h2>

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $e): ?>
        <li><?php echo $e; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form method="post">
    <label>Títol:
        <input type="text" name="title" value="<?php echo $event["title"]; ?>">
    </label><br>

    <label>Descripció:
        <textarea name="description"><?php echo $event["description"]; ?></textarea>
    </label><br>

    <label>Lloc:
        <input type="text" name="location" value="<?php echo $event["location"]; ?>">
    </label><br>

    <label>Data:
        <input type="date" name="event_date" value="<?php echo $event["event_date"]; ?>">
    </label><br>

    <label>Preu:
        <input type="number" step="0.01" name="price" value="<?php echo $event["price"]; ?>">
    </label><br>

    <button type="submit">Guardar canvis</button>
</form>

<?php include "../includes/footer.php"; ?>