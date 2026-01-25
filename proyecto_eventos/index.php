<?php include "includes/header.php"; ?>

<main>
    <h2>Benvingut/da al Gestor d'Events</h2>

    <p>
        Aquesta aplicació web et permet gestionar events i inscripcions de manera senzilla.
    </p>

    <h3>Què pots fer aquí?</h3>

    <ul>
        <li><strong>Organitzadors:</strong> poden crear, editar i eliminar els seus events.</li>
        <li><strong>Assistents:</strong> poden consultar els events i inscriure’s.</li>
        <li><strong>Tots els usuaris poden veure les seves inscripcions.</strong></li>
    </ul>

    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'organitzador'): ?>
        <p><strong>Ets organitzador.</strong> Ves a la secció <em>Events</em> per gestionar els teus events.</p>
    <?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'assistent'): ?>
        <p><strong>Ets assistent.</strong> Ves a <em>Events</em> per inscriure’t o a <em>Inscripcions</em> per veure les teves.</p>
    <?php else: ?>
        <p>Inicia sessió o registra’t per començar a utilitzar l’aplicació.</p>
    <?php endif; ?>
</main>

<?php include "includes/footer.php"; ?>