<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 
    $db = conectarDB();
    $query = "SELECT Id_Clientes, Nom, ApeP FROM clientes;";
    $resultadoC=mysqli_query($db,$query);
    $query = "SELECT Id_NoEmpleado, Nom, ApeP FROM empleados;";
    $resultadoE=mysqli_query($db,$query);


    $clienteId ='';
    $empleadoId ='';

?>
    <main class="contenedor seccion">
        <h1>Agregar Caso</h1>

        <a href="/admin/Casos/casos.php" class="boton boton-azul">Volver</a>
        <form action="POST" class="formulario">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="juzgado">Juzgado</label>
                <input type="text" id="juzgado" name="juzgado" placeholder="Juzgado">

                <label for="materia">Materia</label>
                <input type="text" id="materia" name="materia" placeholder="Materia">
                
                <label for="costo">Costo</label>
                <input type="number" id="costo" name="costo" placeholder="Costo">
            </fieldset>

            <fieldset>
                <legend>Fecha de Registro</legend>
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
                <legend>Cliente y Empleado</legend>
                <label for="cliente">Cliente</label>
                <select name="cliente" id="cliente">
                    <option value="" disabled selected>--Seleccione--</option>
                    <?php while ($cliente = mysqli_fetch_assoc($resultadoC) ): ?>
                        <option <?php echo $clienteId ===$cliente['Id_Clientes'] ? 'selected' :''; ?> value="<?php echo $cliente['Id_Clientes']; ?>"><?php echo $cliente['Nom']. " ". $cliente['ApeP']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="abogado">Abogado</label>
                <select name="abogado" id="abogado">
                    <option value="" disabled selected>--Seleccione--</option>
                    <?php while ($empleado = mysqli_fetch_assoc($resultadoE) ): ?>
                        <option <?php echo $empleadoId ===$empleado['Id_NoEmpleado'] ? 'selected' :''; ?> value="<?php echo $empleado['Id_NoEmpleado']; ?>"><?php echo $empleado['Nom']. " ". $empleado['ApeP']; ?></option>
                    <?php endwhile; ?>
                </select>
            </Fieldset>

            <fieldset>
                <legend>Documentos</legend>
                <label for="ine">INE</label>
                <input type="file" name="ine" id="ine">                
            </fieldset>
            
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>