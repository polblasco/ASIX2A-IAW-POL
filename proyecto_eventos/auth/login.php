<?php
require_once "../config/config.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = esc($conn, $_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT u.id, u.name, u.email, u.password, r.name AS role_name
            FROM users u
            JOIN roles r ON u.role_id = r.id
            WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_role"] = $user["role_name"];

        header("Location: /pol/proyecto_eventos/index.php");
        exit;
    } else {
        $errors[] = "Credencials incorrectes.";
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2>Login</h2>

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $e): ?>
        <li><?php echo $e; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form method="post">
    <label>Email:
        <input type="email" name="email">
    </label><br>

    <label>Contrasenya:
        <input type="password" name="password">
    </label><br>

    <button type="submit">Entrar</button>
</form>

<?php include "../includes/footer.php"; ?>