<?php
$preu = $_POST["preu"];
$iva = $_POST["iva"];

$total = $preu + ($preu * $iva / 100);
echo "El preu amb IVA es: $total €";
?>