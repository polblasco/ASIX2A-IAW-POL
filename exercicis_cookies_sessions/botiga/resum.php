<?php
session_start();
$cistella = $_SESSION['cistella'] ?? ["terrasses" => 0, "raventos" => 0];
$preus = ["terrasses" => 39, "raventos" => 25];

$total = $cistella['terrasses'] * $preus['terrasses'] + $cistella['raventos'] * $preus['raventos'];
?>
<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>Resum de la compra</title>
    </head>
    <body>
        <h1>Resum de la compra</h1>
        <p>Vi Les Terrasses: <?php echo $cistella['terrasses']; ?> unitats</p>
        <p>Cava Raventós i Blanc: <?php echo $cistella['raventos']; ?> unitats</p>
        <p><b>Total: <?php echo $total; ?> €</b></p>

        <form action="confirmar.php" method="POST">
            <button type="submit">Confirmar compra</button>
        </form>
    </body>
</html>