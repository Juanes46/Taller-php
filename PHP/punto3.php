<?php

class CalculadoraEstadistica
{
    private $numeros;

    public function __construct($numeros)
    {
        // Convierte los valores ingresados en un array de números flotantes
        $this->numeros = array_map('floatval', $numeros);
    }

    public function calcularPromedio()
    {
        if (count($this->numeros) === 0) return 0;
        return array_sum($this->numeros) / count($this->numeros);
    }

    public function calcularMediana()
    {
        $cantidad = count($this->numeros);
        if ($cantidad === 0) return 0;

        sort($this->numeros); // Ordena los números en orden ascendente
        $mitad = floor($cantidad / 2);

        if ($cantidad % 2 == 0) {
            return ($this->numeros[$mitad - 1] + $this->numeros[$mitad]) / 2;
        } else {
            return $this->numeros[$mitad];
        }
    }

    public function calcularModa()
    {
        $frecuencias = array_count_values($this->numeros); // Cuenta la frecuencia de cada número
        $maxFrecuencia = max($frecuencias); // Encuentra la frecuencia máxima

        $modas = array_keys($frecuencias, $maxFrecuencia); // Encuentra los números con la frecuencia máxima

        if (count($modas) == count($this->numeros)) {
            return "No hay moda"; // Si todos los números aparecen la misma cantidad de veces
        }

        return implode(", ", $modas); // Retorna la moda en formato de texto
    }
}

// Procesar la solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["numeros"]) && !empty(trim($_POST["numeros"]))) {
        $numerosInput = explode(",", $_POST["numeros"]);
        $numerosInput = array_map('trim', $numerosInput); // Elimina espacios en blanco

        $calculadora = new CalculadoraEstadistica($numerosInput);

        echo "<h2>Resultados</h2>";
        echo "<p><strong>Promedio:</strong> " . number_format($calculadora->calcularPromedio(), 2) . "</p>";
        echo "<p><strong>Mediana:</strong> " . number_format($calculadora->calcularMediana(), 2) . "</p>";
        echo "<p><strong>Moda:</strong> " . $calculadora->calcularModa() . "</p>";
        echo "<a href='index.html'>Volver</a>";
    } else {
        echo "<h2>Error: No ingresaste números válidos.</h2>";
        echo "<a href='index.html'>Volver</a>";
    }
} else {
    echo "<h2>Error: Método de solicitud no válido.</h2>";
}

?>
