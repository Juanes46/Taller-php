<?php
if ($_SERVER["REQUEST_METHOD"] == "post") {
    $frase = $_post['frase'];

    // Eliminar signos de puntuación, excepto los espacios y guiones
    $frase = preg_replace("/[^a-zA-Z0-9-\s]/", "", $frase);

    // Dividir la frase en palabras usando espacios y guiones como separadores
    $palabras = preg_split("/[\s-]+/", $frase);

    // Obtener la primera letra de cada palabra y convertirla a mayúscula
    $acronimo = "";
    foreach ($palabras as $palabra) {
        $acronimo .= strtoupper($palabra[0]);
    }

    // Mostrar el resultado
    echo "<h2>Frase ingresada: $frase</h2>";
    echo "<h2>Acrónimo: <strong>$acronimo</strong></h2>";
} else {
    echo "<h2>Error: No se recibió ninguna frase.</h2>";
}
?>
<br>
<a href="../HTML/punto1.html">Volver</a>
