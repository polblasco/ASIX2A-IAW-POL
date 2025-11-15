<?php
// Guardem les dades en cookies
if (isset($_POST['majoredat'])) {
    setcookie("majoredat", $_POST['majoredat'], time() + (86400 * 30), "/");
    setcookie("idioma", $_POST['idioma'], time() + (86400 * 30), "/");
    setcookie("moneda", $_POST['moneda'], time() + (86400 * 30), "/");
    // refresquem per llegir les cookies
    header("Location: informacio.php");
    exit();
}

// Llegim les cookies
$majoredat = isset($_COOKIE['majoredat']) ? $_COOKIE['majoredat'] : null;
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : null;
$moneda = isset($_COOKIE['moneda']) ? $_COOKIE['moneda'] : null;

// Traduccions de missatges
$missatges = [
    "cat" => [
        "menor" => "No et podem vendre alcohol si ets menor d’edat.",
        "producte1" => "T’oferim el vi “Les Terrasses” a un preu de ",
        "producte2" => "També tenim el cava “Raventós i Blanc” a un preu de "
    ],
    "esp" => [
        "menor" => "No podemos venderte alcohol si eres menor de edad.",
        "producte1" => "Te ofrecemos el vino “Les Terrasses” a un precio de ",
        "producte2" => "También tenemos el cava “Raventós i Blanc” a un precio de "
    ],
    "eng" => [
        "menor" => "We cannot sell you alcohol if you are underage.",
        "producte1" => "We offer the wine “Les Terrasses” at a price of ",
        "producte2" => "We also have the cava “Raventós i Blanc” at a price of "
    ]
];

// Preus segons moneda
$preus = [
    "eur" => ["Les Terrasses" => "39 €", "Raventós i Blanc" => "25 €"],
    "gbp" => ["Les Terrasses" => "34 £", "Raventós i Blanc" => "22 £"],
    "usd" => ["Les Terrasses" => "42 $", "Raventós i Blanc" => "27 $"]
];
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Informació Bodega</title>
</head>
<body>
    <h1>Informació de la Bodega</h1>
    <?php if ($majoredat === "no"): ?>
        <p><?php echo $missatges[$idioma]["menor"]; ?></p>
    <?php else: ?>
        <p><?php echo $missatges[$idioma]["producte1"] . $preus[$moneda]["Les Terrasses"]; ?></p>
        <p><?php echo $missatges[$idioma]["producte2"] . $preus[$moneda]["Raventós i Blanc"]; ?></p>
    <?php endif; ?>

    <p><a href="bodega.php">Canviar opcions</a></p>
</body>
</html>