<?php
$quantitat = $_POST['quantitat'];
$tipus = $_POST['tipus'];

if ($tipus == "eur_usd") {
  $resultat = $quantitat * 1.1;
  echo "$quantitat € són $resultat $";
} else {
  $resultat = $quantitat * 0.9;
  echo "$quantitat $ són $resultat €";
}
?>