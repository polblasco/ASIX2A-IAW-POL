<?php
$hora = date("H");
$minut = date("i");

if ($hora >= 5 && $hora < 14) {
    echo "Bon dia";
} elseif ($hora >= 14 && $hora < 19) {
    echo "Bona tarda";
} else {
    echo "Bona nit";
}

echo "<br><br>Hora del servidor; " . $hora . ":" . $minut;
?>