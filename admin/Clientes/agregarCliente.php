<?php 
require '../../includes/funciones.php';
inlcuirTemplate("header"); 
?>
    <main class="contenedor seccion">
        <h1>Agregar Cliente</h1>

        <form action="POST" class="formulario">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre">

                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno">
                
                <label for="apellidoM">Apellido Materno</label>
                <input type="text" id="apellidoM" name="apellidoM" placeholder="Apellido Materno">

                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" placeholder="Edad del cliente" min="18" max="100">

                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo">
                    <option value="" selected disabled>--Seleccione--</option>
                    <option value="m">Masculino</option>
                    <option value="f">Femenino</option>
                </select>

                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" placeholder="CURP del cliente">

                <label for="ocupacion">Ocupación</label>
                <input type="text" id="ocupacion" name="ocupacion" placeholder="Ocupación del cliente ej: Arquitecto">
            </fieldset>

            <fieldset>
                <legend>Fecha de nacimiento</legend>
                <label for="dia">Día</label>
                <select name="dia" id="dia">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>

                <label for="mes">Mes</label>
                <select name="mes" id="mes">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>

                <label for="anio">Año</label>
                <select name="anio" id="anio">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>
            </fieldset>

            <fieldset>
                <legend>Domicilio</legend>
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad Ej: CD Guzman">

                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" placeholder="Estado Ej: Jalisco">

                <label for="calle">Calle</label>
                <input type="text" id="calle" name="calle" placeholder="Calle Ej: Donato Guerra">

                <label for="numeroCasa">Numero de Casa</label>
                <input type="number" id="numeroCasa" name="numeroCasa" placeholder="Numero de casa">

                <label for="colonia">Colonia</label>
                <input type="text" id="colonia" name="colonia" placeholder="Colonia Ej: Providencia">
            </fieldset>    

            <fieldset>
                <legend>Contacto</legend>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">

                <label for="telefono">Telefono</label>
                <input type="number" id="telefono" name="telefono" placeholder="Telefono del cliente" maxlength="10" minlength="10"> 
            </Fieldset>

            <fieldset>
                <legend>Documentos</legend>
                <label for="ine">INE</label>
                <input type="file" name="ine" id="ine">

                <label for="com">Comprobante de Domicilio</label>
                <input type="file" name="com" id="com">

                <label for="acta">Acta de Nacimiento</label>
                <input type="file" name="acta" id="acta">                
            </fieldset>
            
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>