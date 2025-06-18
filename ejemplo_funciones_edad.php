<?php
function esFechaValida($anio, $mes, $dia) {
    return checkdate($mes, $dia, $anio);
}

function calcularEdad($anio, $mes, $dia) {
    if (!esFechaValida($anio, $mes, $dia)) {
        return false;
    }

    $anioActual = date("Y");
    $mesActual = date("m");
    $diaActual = date("d");

    if ($anio > $anioActual || ($anio == $anioActual && $mes > $mesActual) || ($anio == $anioActual && $mes == $mesActual && $dia > $diaActual)) {
        return false;
    }

    $edad = $anioActual - $anio;

    if ($mesActual < $mes || ($mesActual == $mes && $diaActual < $dia)) {
        $edad--;
    }

    return $edad;
}

function obtenerDescuento($edad) {
    if ($edad < 20) {
        return 10;
    } elseif ($edad <= 50) {
        return 30;
    } else {
        return 50;
    }
}

function obtenerColorFondo($edad) {
    if ($edad < 20) {
        return "lightgreen";
    } elseif ($edad <= 50) {
        return "yellow";
    } else {
        return "red";
    }
}

// Procesamiento del formulario
$nombre = "";
$edad = "";
$error = "";
$descuento = 0;
$precioFinal = 0;
$precioBase = 1000;
$colorFondo = "white";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $anio = intval($_POST["anio"]);
    $mes = intval($_POST["mes"]);
    $dia = intval($_POST["dia"]);

    if (empty($nombre)) {
        $error = "Por favor ingresa tu nombre.";
    } else {
        $edadCalculada = calcularEdad($anio, $mes, $dia);
        if ($edadCalculada === false) {
            $error = "Por favor ingresa una fecha válida.";
        } else {
            $edad = $edadCalculada;
            $descuento = obtenerDescuento($edad);
            $precioFinal = $precioBase - ($precioBase * $descuento / 100);
            $colorFondo = obtenerColorFondo($edad);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del descuento</title>
    <link rel="stylesheet" href="ejemplo_funciones_edad.css">
    <style>
        body {
            background-color: <?= $colorFondo ?>;
        }
    </style>
</head>
<body>
    <h1>Resultado del descuento</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php else: ?>
        <p>Hola <strong><?= htmlspecialchars($nombre) ?></strong>, tienes <strong><?= $edad ?></strong> años.</p>
        <p>Tu descuento es del <strong><?= $descuento ?>%</strong>.</p>
        <p>Precio original: $<?= number_format($precioBase, 2) ?></p>
        <p>Precio con descuento: <strong>$<?= number_format($precioFinal, 2) ?></strong></p>
    <?php endif; ?>

    <p><a href="formulario.html">Volver al formulario</a></p>
</body>
</html>


