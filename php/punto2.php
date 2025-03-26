<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcion = $_POST['opcion'];
    $numero = intval($_POST['numero']);
    
    if ($opcion == 1) {
        echo "<h3>Sucesión de Fibonacci:</h3>";
        $a = 0;
        $b = 1;
        for ($i = 0; $i < $numero; $i++) {
            $c = $a + $b;
            echo "$a + $b = $c <br>";
            $a = $b;
            $b = $c;
        }
    } elseif ($opcion == 2) {
        if ($numero < 0) {
            echo "No se puede calcular el factorial de un número negativo.";
        } else {
            $factorial = 1;
            for ($i = 1; $i <= $numero; $i++) {
                $factorial *= $i;
            }
            echo "El factorial de $numero es: $factorial";
        }
    } else {
        echo "Respuesta no válida.";
    }
}
?>