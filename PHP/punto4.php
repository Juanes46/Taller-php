<?php

class Conjunto
{
    private $elementos;

    public function __construct($elementos)
    {
        // Convierte los valores ingresados en un array de números enteros y elimina duplicados
        $this->elementos = array_unique(array_map('intval', $elementos));
    }

    public function getElementos()
    {
        return $this->elementos;
    }

    public function union(Conjunto $otroConjunto)
    {
        return array_unique(array_merge($this->elementos, $otroConjunto->getElementos()));
    }

    public function interseccion(Conjunto $otroConjunto)
    {
        return array_values(array_intersect($this->elementos, $otroConjunto->getElementos()));
    }

    public function diferencia(Conjunto $otroConjunto)
    {
        return array_values(array_diff($this->elementos, $otroConjunto->getElementos()));
    }
}

// Procesar la solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["conjuntoA"]) && !empty($_POST["conjuntoB"])) {
        $conjuntoAInput = explode(",", $_POST["conjuntoA"]);
        $conjuntoBInput = explode(",", $_POST["conjuntoB"]);

        $conjuntoA = new Conjunto($conjuntoAInput);
        $conjuntoB = new Conjunto($conjuntoBInput);

        echo "<h1>Resultados</h1>";
        echo "<p><strong>Unión:</strong> {" . implode(", ", $conjuntoA->union($conjuntoB)) . "}</p>";
        echo "<p><strong>Intersección:</strong> {" . implode(", ", $conjuntoA->interseccion($conjuntoB)) . "}</p>";
        echo "<p><strong>Diferencia (A - B):</strong> {" . implode(", ", $conjuntoA->diferencia($conjuntoB)) . "}</p>";
        echo "<p><strong>Diferencia (B - A):</strong> {" . implode(", ", $conjuntoB->diferencia($conjuntoA)) . "}</p>";
    } else {
        echo "<h2>Error: Debes ingresar ambos conjuntos.</h2>";
    }
} else {
    echo "<h2>Error: Método de solicitud no válido.</h2>";
}

?>
