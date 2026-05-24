<?php
session_start();

// RESET (cambiar nombre)
if (isset($_POST["reset"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// GUARDAR NOMBRE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"])) {
    $_SESSION["nombre"] = htmlspecialchars($_POST["nombre"]);
}

// OBTENER NOMBRE
$nombre = $_SESSION["nombre"] ?? "";

// SALUDO DINÁMICO
$hora = date("H");
if ($hora < 12) {
    $saludo = "Buenos días ☀️";
} elseif ($hora < 18) {
    $saludo = "Buenas tardes 🌤️";
} else {
    $saludo = "Buenas noches 🌙";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mi Web PRO</title>

<style>
:root {
    --bg: linear-gradient(135deg, #667eea, #764ba2);
    --text: white;
}

.dark {
    --bg: #121212;
    --text: #f1f1f1;
}

body {
    margin: 0;
    font-family: Arial;
    background: var(--bg);
    color: var(--text);
    transition: 0.5s;
    text-align: center;
}

.container {
    margin-top: 100px;
}

.card {
    background: rgba(0,0,0,0.3);
    padding: 30px;
    border-radius: 20px;
    display: inline-block;
    backdrop-filter: blur(10px);
    animation: fadeIn 1s ease;
}

input, button {
    padding: 10px;
    border: none;
    border-radius: 10px;
    margin-top: 10px;
}

button {
    background: #ff7b00;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.1);
}

.toggle {
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
    font-size: 20px;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

</head>

<body>

<div class="toggle" onclick="toggleDark()">🌙</div>

<div class="container">
    <div class="card">

        <h1><?php echo $saludo; ?></h1>

        <?php if ($nombre): ?>
            <h2>Hola, <?php echo $nombre; ?> 👋</h2>
            <p>Bienvenido a tu web amigo 🔥</p>

            <form method="POST">
                <button type="submit" name="reset">Cambiar nombre</button>
            </form>

        <?php else: ?>
            <p>Escribe tu nombre:</p>
            <form method="POST">
                <input type="text" name="nombre" required>
                <br>
                <button type="submit">Entrar</button>
            </form>
        <?php endif; ?>

    </div>
</div>

<script>
function toggleDark() {
    document.body.classList.toggle("dark");
}
</script>

</body>
</html>