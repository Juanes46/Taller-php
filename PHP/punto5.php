<?php


// Verificamos si el usuario envió un número
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numero'])) {
    $numero = intval($_POST['numero']); // Convertimos el dato a número entero
    $binario = new Binario($numero); // Creamos un objeto de la clase Binario
    $resultado = $binario->convertir(); // Llamamos al método convertir()
} else {
    die("Error: No se recibió un número válido.");
}
?>


<body>
    <h1>Resultado de Conversión</h1>
    <p>El número <strong><?php echo $numero; ?></strong> en binario es:</p>
    <h2><?php echo $resultado; ?></h2>

</body>


<?php
class Binario {
    private $numero;

    public function __construct($numero) {
        $this->numero = $numero;
    }

    public function convertir() {
        return decbin($this->numero); // Convierte el número a binario
    }
}
?>
