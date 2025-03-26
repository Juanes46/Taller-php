<?php  
class Nodo {  
    public $valor;  
    public $izquierdo;  
    public $derecho;  

    public function __construct($valor) {  
        $this->valor = $valor;  
        $this->izquierdo = null;  
        $this->derecho = null;  
    }  
}  

class ArbolBinario {  
    public $raiz;  

    public function __construct() {  
        $this->raiz = null;  
    }  

    public function insertar($valor) {  
        $this->raiz = $this->insertarRecursivo($this->raiz, $valor);  
    }  

    private function insertarRecursivo($nodo, $valor) {  
        if ($nodo == null) {  
            return new Nodo($valor);  
        }  

        if ($valor < $nodo->valor) {  
            $nodo->izquierdo = $this->insertarRecursivo($nodo->izquierdo, $valor);  
        } elseif ($valor > $nodo->valor) {  
            $nodo->derecho = $this->insertarRecursivo($nodo->derecho, $valor);  
        }  

        return $nodo;  
    }  

    public function preorden($nodo) {  
        if ($nodo == null) return [];  
        return array_merge(  
            [$nodo->valor],  
            $this->preorden($nodo->izquierdo),  
            $this->preorden($nodo->derecho)  
        );  
    }  

    public function inorden($nodo) {  
        if ($nodo == null) return [];  
        return array_merge(  
            $this->inorden($nodo->izquierdo),  
            [$nodo->valor],  
            $this->inorden($nodo->derecho)  
        );  
    }  

    public function postorden($nodo) {  
        if ($nodo == null) return [];  
        return array_merge(  
            $this->postorden($nodo->izquierdo),  
            $this->postorden($nodo->derecho),  
            [$nodo->valor]  
        );  
    }  

    public function imprimirArbol($nodo = null, $nivel = 0, &$niveles = []) {  
        if ($nodo === null && $nivel === 0) {  
            $nodo = $this->raiz;  
            $niveles = [];  
        }  
        if ($nodo === null) return;  

        $niveles[$nivel][] = $nodo->valor;  
        $this->imprimirArbol($nodo->izquierdo, $nivel + 1, $niveles);  
        $this->imprimirArbol($nodo->derecho, $nivel + 1, $niveles);  

        if ($nivel === 0) {  
            echo "<div class='arbol'>";  
            ksort($niveles);  
            foreach ($niveles as $nivelArray) {  
                echo "<div class='nivel'>";  
                foreach ($nivelArray as $valor) {  
                    echo "<div class='nodo'>{$valor}</div>";  
                }  
                echo "</div>";  
            }  
            echo "</div>";  
        }  
    }  
}  

// Comprobar si se ha enviado el formulario  
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valor'])) {  
    $arbol = new ArbolBinario();  
    $valores = explode(" ", strtoupper(trim($_POST['valor'])));  
    
    // Insertar valores en el árbol  
    foreach ($valores as $val) {  
        $arbol->insertar($val);  
    }  

    // Mostrar resultados  
    echo "<h3>Recorridos del Árbol:</h3>";  
    echo "Preorden: " . implode(" ", $arbol->preorden($arbol->raiz)) . "<br>";  
    echo "Inorden: " . implode(" ", $arbol->inorden($arbol->raiz)) . "<br>";  
    echo "Postorden: " . implode(" ", $arbol->postorden($arbol->raiz)) . "<br>";  

    echo "<h3>Árbol Binario Visual:</h3>";  
    $arbol->imprimirArbol($arbol->raiz);  
}  
?>  