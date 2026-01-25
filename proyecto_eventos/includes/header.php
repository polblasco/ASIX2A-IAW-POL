<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Projecte Events</title>
    <link rel="stylesheet" href="/pol/proyecto_eventos/assets/css/styles.css">
</head>
<body>

<header class="main-header">
    <div><h1>Projecte de Gestió d'Events</h1></div>

    <nav class="nav-links">
        <a href="/pol/proyecto_eventos/index.php">Inici</a>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="/pol/proyecto_eventos/auth/login.php">Login</a>
            <a href="/pol/proyecto_eventos/auth/register.php">Registre</a>
        <?php else: ?>

            <a href="/pol/proyecto_eventos/events/events_list.php">Events</a>
            <a href="/pol/proyecto_eventos/registrations/registrations_list.php">Inscripcions</a>
            <span>
                Usuari: <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                (<?php echo htmlspecialchars($_SESSION['user_role']); ?>)
            </span>
            <a href="/pol/proyecto_eventos/auth/logout.php">Tancar sessió</a>
        <?php endif; ?>
    </nav>

    <hr>
</header>