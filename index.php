<?php 
require 'includes/funciones.php';
inlcuirTemplate("header"); 
?>

    <main class="contenedor seccion">
        <!--<h1>Gestor Juridico</h1>-->
        <h2>Iniciar Sesión</h2>
        <form method="POST" class="formulario">
            <fieldset>
                <legend>Usuario y Contraseña</legend>

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" placeholder="Tu Usuario" id="usuario" required>

                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" placeholder="Tu contraseña" id="contraseña" required>
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>
    
