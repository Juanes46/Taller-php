<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['frase']) && !empty(trim($_POST['frase']))) {
        
        // Obtiene la frase y la sanitiza
        $frase = trim($_POST['frase']);

        class Acronimo
        {
            private $frase;
            private $acronimo;

            public function __construct($frase)
            {
                $this->setFrase($frase);
            }

            public function setFrase($frase)
            {
                $this->frase = $this->procesarFrase($frase);
                $this->acronimo = $this->generarAcronimo();
            }

            public function getAcronimo()
            {
                return $this->acronimo;
            }

            private function procesarFrase($frase)
            {
                $frase = strtoupper($frase);
                $fraseLimpia = "";

                for ($i = 0; $i < strlen($frase); $i++) {
                    $caracter = $frase[$i];

                    if (ctype_alpha($caracter) || $caracter == ' ' || $caracter == '-' || $caracter == '_' ) {
                        $fraseLimpia .= $caracter;
                    }
                }

                return trim($fraseLimpia);
            }

            private function generarAcronimo()
            {
                $acronimo = "";
                $longitud = strlen($this->frase);
                $tomarLetra = true;

                for ($i = 0; $i < $longitud; $i++) {
                    $caracter = $this->frase[$i];

                    if ($tomarLetra && ctype_alpha($caracter)) {
                        $acronimo .= $caracter;
                        $tomarLetra = false;
                    }

                    if ($caracter == ' ' || $caracter == '-' || $caracter == '_') {
                        $tomarLetra = true;
                    }
                    
                }

                return $acronimo;
            }
        }


        $datos = new Acronimo($frase);

        // Muestra el acrónimo generado
        echo "<h2>El acrónimo de '" . htmlspecialchars($frase) . "' es: " . htmlspecialchars($datos->getAcronimo()) . "</h2>";

    } else {
        echo "<h2>Error: No ingresaste una frase válida.</h2>";
    }
} else {
    echo "<h2>Error: Método de solicitud no válido.</h2>";
}

?>
