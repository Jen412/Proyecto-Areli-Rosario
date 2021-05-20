<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'FernandoB', 'Evilafm440', 'gestor_juridico');
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }
    return $db;
}