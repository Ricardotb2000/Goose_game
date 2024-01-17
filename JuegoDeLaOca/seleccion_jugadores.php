<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Jugadores</title>
    <link rel="stylesheet" type="text/css" href="styles_Seleccion.css">
</head>
<body>
    <header>
        <a href="inicio_oca.php">
            <img src="imagenes/logo_oca2.png" alt="Logo de Juego de la Oca">
        </a>
    </header>
    <?php
    if (isset($_GET['jugadores'])) {
        $cantidad_jugadores = intval($_GET['jugadores']);

        if ($cantidad_jugadores >= 2 && $cantidad_jugadores <= 4) {
            echo '<form action="menu_seleccion.php" method="post">';
            for ($i = 1; $i <= $cantidad_jugadores; $i++) {
                echo '<label for="nombre_j' . $i . '">Nombre J' . $i . ':</label>';
                echo '<input type="text" id="nombre_j' . $i . '" name="nombre_j' . $i . '" placeholder="Introduce tu nombre"><br>';
                echo '<label for="color_j' . $i . '">Color:</label>';
                echo '<input type="color" id="color_j' . $i . '" name="color_j' . $i . '" value="' . getColorPorDefecto($i) . '"><br>';
            }
            echo '<input type="hidden" name="cantidad_jugadores" value="' . $cantidad_jugadores . '">';
            echo '<input type="submit" value="Empezar" class="btn">';
            echo '</form>';
        } else {
            echo 'La cantidad de jugadores seleccionada no es válida.';
        }
    } else {
        echo 'Debe seleccionar la cantidad de jugadores desde la página anterior.';
    }

    function getColorPorDefecto($numeroJugador) {
        $colores = ['#FF0000', '#0000FF', '#008000', '#FFFF00']; // Rojo, Azul, Verde, Amarillo
        return $colores[$numeroJugador - 1];
    }
    ?>
</body>
</html>
