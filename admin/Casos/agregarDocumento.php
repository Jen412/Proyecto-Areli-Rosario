<?php 
require '../../includes/funciones.php';
inlcuirTemplate("header"); 
?>
    <main class="contenedor seccion">
        <h1>Agregar Documento</h1>
        <a href="/admin/Casos/documentosCaso.php" class="boton-azul">Volver</a>
        <form action="" class="formulario">
            <fieldset>
                <legend>Documento</legend>
                <label for="doc">Documento</label>
                <input type="file" name="doc" id="doc">
            </fieldset>
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>