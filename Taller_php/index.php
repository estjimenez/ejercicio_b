<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function gcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

function mcm($a, $b) {
    return abs($a * $b) / gcd($a, $b);
}

$mensaje = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vueltas = (int)$_POST["vueltas"];
    $tiempoA = (int)$_POST["tiempoA"];
    $tiempoB = (int)$_POST["tiempoB"];

    if ($tiempoA <= 0 || $tiempoB <= 0 || $tiempoA == $tiempoB || $vueltas <= 0) {
        $mensaje = "<h2>❌ Datos inválidos.</h2>
                    <p>Los tiempos deben ser mayores a 0 y diferentes. Las vueltas deben ser positivas.</p>";
    } else {
        $tiempoCoincidencia = mcm($tiempoA, $tiempoB);
        $coincidencias = [];
        $i = 1;

        while (true) {
            $tiempo = $tiempoCoincidencia * $i;
            $vueltasA = $tiempo / $tiempoA;
            $vueltasB = $tiempo / $tiempoB;

            if ($vueltasA > $vueltas || $vueltasB > $vueltas) {
                break;
            }

            $coincidencias[] = [
                'tiempo' => $tiempo,
                'vueltasA' => $vueltasA,
                'vueltasB' => $vueltasB
            ];
            $i++;
        }

        if (count($coincidencias) > 0) {
            $mensaje = "<h2>✅ Coincidencias encontradas</h2>";
            $resultado .= "<table border='1' cellpadding='10' style='margin-top:20px; border-collapse:collapse; width:100%;'>
                            <tr>
                                <th>#</th>
                                <th>Tiempo (min)</th>
                                <th>Vueltas A</th>
                                <th>Vueltas B</th>
                            </tr>";
            foreach ($coincidencias as $index => $c) {
                $resultado .= "<tr>
                                  <td>" . ($index + 1) . "</td>
                                  <td>{$c['tiempo']}</td>
                                  <td>{$c['vueltasA']}</td>
                                  <td>{$c['vueltasB']}</td>
                               </tr>";
            }
            $resultado .= "</table>";
        } else {
            $mensaje = "<h2>❌ No coinciden dentro de las $vueltas vueltas.</h2>";
        }
    }
} else {
    $mensaje = "<h2>Acceso no permitido</h2>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <?= $mensaje ?>
    <?= $resultado ?>
    <br>
    <a href="index.html"><button>🔙 Volver al formulario</button></a>
  </div>
</body>
</html>
