<?php
require_once "../config/auth_check.php";
require_once "../config/config.php";

if ($_SESSION["user_role"] !== "organitzador") {
    header("Location: ../config/error.php?msg=No tens permís per crear events");
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
        $sql = "INSERT INTO events (title, description, location, event_date, price, created_by)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssdi",
            $title, $description, $location, $event_date, $price, $_SESSION["user_id"]
        );
        mysqli_stmt_execute($stmt);

        header("Location: events_list.php");
        exit;
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2>Crear nou event</h2>

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $e): ?>
        <li><?php echo $e; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form method="post">
    <label>Títol:
        <input type="text" name="title">
    </label><br>

    <label>Descripció:
        <textarea name="description"></textarea>
    </label><br>

    <label>Lloc:
        <input type="text" name="location">
    </label><br>

    <label>Data:
        <input type="date" name="event_date">
    </label><br>

    <label>Preu:
        <input type="number" step="0.01" name="price" value="0">
    </label><br>

    <button type="submit">Crear</button>
</form>

<?php include "../includes/footer.php"; ?>