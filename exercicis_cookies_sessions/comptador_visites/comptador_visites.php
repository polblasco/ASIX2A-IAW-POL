<?php
$cookie_name = "visites";
if (isset($_COOKIE[$cookie_name])) {
    $visites = $_COOKIE[$cookie_name] + 1;
} else {
    $visites = 1;
}
setcookie($cookie_name, $visites, time() + (86400 * 30), "/");
?>

<!DOCTYPE html>
<html lang="ca">
    <head>
        <meta charset="UTF-8">
        <title>Comptador de visites</title>
    </head>
    <body>
        <h1>Has visitat aquesta pàgina <?php echo $visites; ?> vegades</h1>
    </body>
</html>