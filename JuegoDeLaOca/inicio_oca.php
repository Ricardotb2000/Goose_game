<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
    <link rel="icon" href="imagenes/logo_oca2.png">
    <link rel="stylesheet" type="text/css" href="styles_Inicio.css">
</head>
<body>
<script src="inicio_oca.js"></script>
    <div id="background">
    <header>
        <img id="logo" src="imagenes/logo_oca2.png" alt="Logo de Juego de la Oca">
    </header>

    <h1>
        Bienvenido al Juego de la Oca
    </h1>
    <h2>
        ¿Cuántas personas van a jugar?
    </h2>
    <form action="seleccion_jugadores.php" method="post">
        <div class="btn-container">
            <input type="button" value="2 Jugadores" id="2J"
             class="btn" onclick="window.location.href='seleccion_jugadores.php?jugadores=2';">
            <input type="button" value="3 Jugadores" id="3J"
             class="btn" onclick="window.location.href='seleccion_jugadores.php?jugadores=3';">
            <input type="button" value="4 Jugadores" id="4J"
             class="btn" onclick="window.location.href='seleccion_jugadores.php?jugadores=4';">
        </div>
    </form>
    </div>
</body>
</html>
