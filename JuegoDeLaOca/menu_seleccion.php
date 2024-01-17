<?php
// iniciar sesion para almacenar el estado del juego
session_start();

// guardar informacion de los jugadores solo si se envia desde el formulario de seleccion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cantidad_jugadores'])) {
    $_SESSION['cantidad_jugadores'] = $_POST['cantidad_jugadores'];
    for ($i = 1; $i <= $_SESSION['cantidad_jugadores']; $i++) {
        $_SESSION["jugador$i"] = [
            "nombre" => $_POST["nombre_j$i"],
            "color" => $_POST["color_j$i"],
            "posicion" => 1 // todos empiezan en la casilla 1
        ];
    }
    $_SESSION["turno"] = 1; // comienza el primer jugador
    $_SESSION["dado"] = 0; // reiniciar el valor del dado
    $_SESSION["mensaje"] = ""; // reiniciar el mensaje
}

// logica para lanzar el dado y avanzar las fichas
if (isset($_POST['lanzar_dado'])) {
    // asegurarse de que hay jugadores antes de lanzar el dado
    if (isset($_SESSION['cantidad_jugadores']) && $_SESSION['cantidad_jugadores'] > 0) {
        $dado = rand(1, 6); // lanzar el dado
        $_SESSION["dado"] = $dado; // guarda el resultado del dado en la sesion
        
        // determina el jugador actual y actualiza su posicion
        $jugadorActual = "jugador" . $_SESSION["turno"];
        $_SESSION[$jugadorActual]["posicion"] += $dado;
        
        // asegurarse de que la posicion no se pase del tamaño del tablero
        if ($_SESSION[$jugadorActual]["posicion"] > 30) {
            $_SESSION[$jugadorActual]["posicion"] = 30;
        }
        
        // verificar si un jugador ha ganado
        if ($_SESSION[$jugadorActual]["posicion"] == 30) {
            $_SESSION["mensaje"] = "¡{$jugadorActual} ha ganado el juego!";
        } else {
            // cambiar al siguiente jugador
            $_SESSION["turno"] = ($_SESSION["turno"] % $_SESSION['cantidad_jugadores']) + 1;
        }
    }
}

// redirigir si no hay jugadores configurados
if (!isset($_SESSION["jugador1"])) {
    header("Location: inicio_oca.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablero del Juego de la Oca</title>
    <link rel="stylesheet" type="text/css" href="styles_juego.css">
    <style>
        /* estilos adicionales para las casillas y fichas */
        .casilla {
            width: 120px; /* ancho de las casillas */
            height: 120px; /* alto de las casillas */
            background-color: #ffe4b5; /* color de fondo de las casillas */
            border: 2px solid #8b4513; /* borde de las casillas */
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 20px;
            position: relative; /* necesario para posicionar las fichas */
        }

        .ficha {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: absolute; /* posicion absoluta para las fichas */
            display: flex;
            justify-content: center;
            align-items: center;
            color: black; /* color del texto en la ficha */
            font-weight: bold;
        }
        
        .mensaje {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: black; /* color rojo para el mensaje */
        }
    </style>
</head>
<body>
    <div id="tablero">
        <?php for ($i = 1; $i <= 30; $i++): ?>
            <div class="casilla">
                <?= $i ?> <!-- numero de la casilla -->
                <?php
                // mostrar las fichas en la casilla correspondiente
                for ($j = 1; $j <= $_SESSION['cantidad_jugadores']; $j++) {
                    $jugador = $_SESSION["jugador$j"];
                    if ($jugador["posicion"] == $i) {
                        $top = 10 + ($j - 1) * 30; // ajustar la posicion vertical de las fichas
                ?>
                        <div class="ficha" style="background-color: <?= $jugador['color'] ?>; top: <?= $top ?>px;">
                            <?= $jugador['nombre'] ?> <!-- nombre del jugador dentro de la ficha -->
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        <?php endfor; ?>
    </div>
    <div class="dado">
        Resultado del dado: <?= $_SESSION["dado"] ?? '0' ?><br>
        Turno de <?= $_SESSION["jugador" . $_SESSION["turno"]]["nombre"] ?> <!-- nombre del jugador actual -->
    </div>
    <div class="mensaje">
        <?= $_SESSION["mensaje"] ?? '' ?>
    </div>
    <form method="post">
        <input type="submit" name="lanzar_dado" value="Lanzar Dado">
    </form>
</body>
</html>
