<?php
require_once "config.php";
$message = $_GET['msg'] ?? "Error desconegut";
?>

<?php include "../includes/header.php"; ?>

<main>
    <h2>Error</h2>
    <p><?php echo htmlspecialchars($message); ?></p>
    <a href="/pol/proyecto_eventos/index.php">Tornar a l'inici</a>
</main>

<?php include "../includes/footer.php"; ?>