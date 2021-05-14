<?php 
require 'includes/funciones.php';
inlcuirTemplate("header"); 
?>


    <main class="contenedor seccion">
        <h1>Contactanos</h1>
        <form action="" class="formulario">
            <fieldset>
                <legend>Rellena los siguientes campos</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre">
                <label for="email">E-mail</label>
                <input type="email" id="email">
                <label for="asunto">Asunto</label>
                <input type="text" id="asunto">
                <label for="mensaje">Mensaje</label>
                <textarea  id="mensaje"></textarea>
            </fieldset>
            <input type="submit" value="Enviar" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>