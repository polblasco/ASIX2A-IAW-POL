<?php
session_start();
if (!isset($_SESSION['usuari'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>Pàgina 2</title>
    </head>
    <body>
        <h1>Benvingut/da, <?php echo htmlspecialchars($_SESSION['usuari']); ?>!</h1>
        <p>Aquesta és la segona pàgina d'informació.</p>
        <nav>
            <a href="pagina1.php">Tornar a la pàgina 1</a>
            <a href="logout.php">Tancar la sessió</a>
        </nav>
    </body>
</html>