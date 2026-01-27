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
    <h1>Projecte de Gestió d'Events</h1>

    <nav class="nav-links">
        <ul>
        <li><a href="/pol/proyecto_eventos/index.php">Inici</a></li>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <li><a href="/pol/proyecto_eventos/auth/login.php">Login</a></li>
            <li><a href="/pol/proyecto_eventos/auth/register.php">Registre</a></li>
        <?php else: ?>

            <li><a href="/pol/proyecto_eventos/events/events_list.php">Events</a></li>
            <li><a href="/pol/proyecto_eventos/registrations/registrations_list.php">Inscripcions</a></li>
            <span>
                Usuari: <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                (<?php echo htmlspecialchars($_SESSION['user_role']); ?>)
            </span>
            <li><a href="/pol/proyecto_eventos/auth/logout.php">Tancar sessió</a></li>
        <?php endif; ?>
        </ul>
    </nav>

    <hr>
</header>