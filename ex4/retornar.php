<?php
$musica = $_POST["musica"];

if ($musica == "rock"){
    echo "Visca el Rock and Roll!";
} elseif ($musica == "pop"){
    echo "El pop t'anima el cos.";
} elseif ($musica == "trap"){
    echo "El trap es la millor musica avui en dia pels joves.";
} elseif ($musica == "electronica"){
    echo "T'agrada molt les festes de 24h.";
}
?>