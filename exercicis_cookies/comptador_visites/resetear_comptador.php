<?php
$cookie_name = "contador_visitas";
setcookie($cookie_name, 1, time() + (86400 * 30), "/");
header("Location: comptador_visites.html");
exit();
?>