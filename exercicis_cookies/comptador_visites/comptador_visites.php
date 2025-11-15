<?php
$cookie_name = "contador_visitas";
$descuento_aplicado = false;

if (isset($_COOKIE[$cookie_name])) {
    $contador_visitas = $_COOKIE[$cookie_name] + 1;
} else {
    $contador_visitas = 1;
}
setcookie($cookie_name, $contador_visitas, time() + (86400 * 30), "/");

$mensaje_descuento = "";
if ($contador_visitas == 10) {
    $mensaje_descuento = "Oferta exclusiva sols per a tu! Utilitza el codi BOTIGA50 per obtenir un 50% de descompte en les teves primeres compres a la botiga";
} elseif ($contador_visitas == 5) {
    $mensaje_descuento = "Oferta exclusiva! Utilitza el codi BOTIGA20 per obtenir un 20% de descompte en les teves primeres compres a la botiga";
}

if (isset($_POST['producto']) && isset($_POST['precio'])) {
    $producto = $_POST['producto'];
    $precio = (float) $_POST['precio'];
    $codigo_descuento = isset($_POST['codigo_descuento']) ? $_POST['codigo_descuento'] : "";

    $descuento = 0;
    $mensaje = "No s'ha aplicat cap codi de descompte.";

    if ($codigo_descuento === "BOTIGA20" && $contador_visitas >= 5) {
        $descuento = 20;
        $mensaje = "Has aplicat un descompte del 20% en el producte: $producto.";
        $descuento_aplicado = true;
    } elseif ($codigo_descuento === "BOTIGA50" && $contador_visitas >= 10) {
        $descuento = 50;
        $mensaje = "Has aplicat un descompte del 50% en el producte: $producto.";
        $descuento_aplicado = true;
    }

    $precio_con_descuento = $precio * (1 - $descuento / 100);

    if ($descuento_aplicado) {
        setcookie($cookie_name, 1, time() + (86400 * 30), "/"); // Reseteja el comptador
        $contador_visitas = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Comptador de Visites</title>
</head>
<body>
    <h1>Comptador de Visites</h1>
    <p>Nombre de visites: <?php echo $contador_visitas; ?></p>

    <?php if ($mensaje_descuento): ?>
        <p><?php echo $mensaje_descuento; ?></p>
    <?php endif; ?>

    <?php if (isset($producto)): ?>
        <h2>Resultat de la compra</h2>
        <p><?php echo $mensaje; ?></p>
        <p>Preu original de <?php echo $producto; ?>: <?php echo number_format($precio, 2); ?>€</p>
        <?php if ($descuento > 0): ?>
            <p>Descompte aplicat: <?php echo $descuento; ?>%</p>
            <p>Preu amb descompte: <?php echo number_format($precio_con_descuento, 2); ?>€</p>
        <?php else: ?>
            <p>Preu final: <?php echo number_format($precio, 2); ?>€</p>
        <?php endif; ?>
    <?php endif; ?>

    <p><a href="resetear_comptador.php">Tornar a la pàgina principal</a></p>
</body>
</html>