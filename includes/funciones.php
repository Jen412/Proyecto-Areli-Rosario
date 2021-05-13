<?php

require 'app.php';

function inlcuirTemplate (string $nombre, bool $inicio=false){
    include TEMPLATES_URL . "/${nombre}.php"; 
}