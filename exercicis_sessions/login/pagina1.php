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
        <title>Pàgina 1</title>
    </head>
    <body>
        <h1>Benvingut/da, <?php echo htmlspecialchars($_SESSION['usuari']); ?>!</h1>
        <p>Aquesta és la primera pàgina d'informació.</p>
        <nav>
            <a href="pagina2.php">Anar a la pàgina 2</a>
        </nav>
    </body>
</html>
