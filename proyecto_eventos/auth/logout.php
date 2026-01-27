<?php
session_start();
session_unset();
session_destroy();
header("Location: /pol/proyecto_eventos/index.php");
exit;