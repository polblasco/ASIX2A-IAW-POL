<?php
require_once "../config/config.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = esc($conn, $_POST["name"]);
    $email = esc($conn, $_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $role_id = (int)$_POST["role_id"];

    if ($name === "" || $email === "" || $password === "" || $confirm === "") {
        $errors[] = "Tots els camps són obligatoris.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email no vàlid.";
    }

    if ($password !== $confirm) {
        $errors[] = "Les contrasenyes no coincideixen.";
    }

    // Comprovar duplicats
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $errors[] = "Ja existeix un usuari amb aquest email.";
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $hash, $role_id);
        mysqli_stmt_execute($stmt);

        header("Location: login.php");
        exit;
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2>Registre</h2>

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $e): ?>
        <li><?php echo $e; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form method="post">
    <label>Nom:
        <input type="text" name="name">
    </label><br>

    <label>Email:
        <input type="email" name="email">
    </label><br>

    <label>Contrasenya:
        <input type="password" name="password">
    </label><br>

    <label>Repeteix contrasenya:
        <input type="password" name="confirm">
    </label><br>

    <label>Rol:
        <select name="role_id">
            <option value="2">Assistent</option>
            <option value="1">Organitzador</option>
        </select>
    </label><br>

    <button type="submit">Registrar-se</button>
</form>

<?php include "../includes/footer.php"; ?>