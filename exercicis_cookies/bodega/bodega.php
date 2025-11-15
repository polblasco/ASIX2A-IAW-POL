<?php
// Formulari inicial per seleccionar opcions
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Bodega</title>
</head>
<body>
    <h1>Benvingut a la Bodega</h1>
    <form action="informacio.php" method="POST">
        <label>Ets major d'edat?</label><br>
        <select name="majoredat" required>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>
        <br><br>

        <label>Idioma:</label><br>
        <select name="idioma" required>
            <option value="cat">Català</option>
            <option value="esp">Español</option>
            <option value="eng">English</option>
        </select>
        <br><br>

        <label>Moneda:</label><br>
        <select name="moneda" required>
            <option value="eur">Euros (€)</option>
            <option value="gbp">Lliures (£)</option>
            <option value="usd">Dòlars ($)</option>
        </select>
        <br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>