<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';
    $db =conectarDB();
    inlcuirTemplate("header"); 

    $query = "SELECT Id_Clientes, Nom, ApeP FROM clientes;";
    $resultadoC=mysqli_query($db,$query);
    $query = "SELECT Id_NoEmpleado, Nom, ApeP FROM empleados;";
    $resultadoE=mysqli_query($db,$query);

    $clienteId ='';
    $empleadoId ='';
?>
    <main class="contenedor seccion">
        <h1>Consulta Individual</h1>
        <a href="/admin/Casos/casos.php" class="boton-azul">Volver</a>
        <form action="" method="POST" class="formulario">
            <label for="caso">Seleccione Caso para consultar</label>
            <select name="caso" id="caso">
                <option value="" disabled selected>--Seleccione Caso--</option>
            </select>
            <input type="submit" value="Buscar" class="boton-azul">
        </form>

        <form action="" class="formulario">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="juzgado">Juzgado</label>
                <input disabled type="text" id="juzgado" name="juzgado" placeholder="Juzgado">

                <label for="materia">Materia</label>
                <input disabled type="text" id="materia" name="materia" placeholder="Materia">
                
                <label for="costo">Costo</label>
                <input disabled type="number" id="costo" name="costo" placeholder="Costo">
            </fieldset>

            <fieldset>
                <legend>Fecha de Registro</legend>
                <label for="dia">Día</label>
                <select disabled name="dia" id="dia">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>

                <label for="mes">Mes</label>
                <select disabled name="mes" id="mes">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>

                <label for="anio">Año</label>
                <select disabled name="anio" id="anio">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>
            </fieldset>
   
            <fieldset>
                <legend>Cliente y Empleado</legend>
                <label for="cliente">Cliente</label>
                <select disabled name="cliente" id="cliente">
                    <option value="" disabled selected>--Seleccione--</option>
                    <?php while ($cliente = mysqli_fetch_assoc($resultadoC) ): ?>
                        <option <?php echo $clienteId ===$cliente['Id_Clientes'] ? 'selected' :''; ?> value="<?php echo $cliente['Id_Clientes']; ?>"><?php echo $cliente['Nom']. " ". $cliente['ApeP']; ?></option>
                    <?php endwhile; ?>
                </select>
                <label for="abogado">Abogado</label>
                <select disabled name="abogado" id="abogado">
                    <option value="" disabled selected>--Seleccione--</option>
                    <?php while ($empleado = mysqli_fetch_assoc($resultadoE) ): ?>
                        <option <?php echo $empleadoId ===$empleado['Id_NoEmpleado'] ? 'selected' :''; ?> value="<?php echo $empleado['Id_NoEmpleado']; ?>"><?php echo $empleado['Nom']. " ". $empleado['ApeP']; ?></option>
                    <?php endwhile; ?>
                </select>
            </Fieldset>
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>