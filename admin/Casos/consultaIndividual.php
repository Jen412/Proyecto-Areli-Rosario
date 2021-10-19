<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';
    inlcuirTemplate("header"); 
    //Conexion a la base de datos
    $db = conectarDB();
    //Crear Query para consultar clientes
    $query = "CALL consultaClientes();";
    //Resultado de la consulta
    $resultadoC=mysqli_query($db,$query);
    //Conexion a la base de datos
    $db = conectarDB();
    //Crear Query para consultar
    $query = "CALL consultaEmpleados();";
    //Resultado de la consulta
    $resultadoE=mysqli_query($db,$query);
    //obtiene el id de la URL
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //si id lo cambian regresa 
    if (!$id) {
        header('Location: /admin/Empleados');
    }
    //Conexion a la base de datos de nuevo
    $db = conectarDB();
    //consulta para obtener datos del caso
    $query ="CALL consultaCasoAct('$id')";
    $resultado = mysqli_query($db, $query);
    $caso = mysqli_fetch_assoc($resultado);

    $juzgado = $caso['Juzgado'];
    $estatus = $caso['Estatus'];
    $materia = $caso['Materia'];
    $costo = $caso['Costo'];
    $dia = $caso['DiaR']; 
    $mes = $caso['MesR'];
    $anio = $caso['AnioR'];
    $clienteId = $caso['Id_Clientes'];
    $empleadoId = $caso['Id_NoEmpleado'];

    switch ($mes) {
        case '1':
            $mes = "Enero";
            break;
        case '2':
            $mes = "Febrero";
            break;
        case '3':
            $mes = "Marzo";
            break;
        case '4':
            $mes = "Abril";
            break;
        case '5':
            $mes = "Mayo";
            break;
        case '6':
            $mes = "Junio";
            break;       
        case '7':
            $mes = "Julio";
            break; 
        case '8':
            $mes = "Agosto";
            break;        
        case '9':
            $mes = "Septiembre";
            break;        
        case '10':
            $mes = "Octubre";
            break;        
        case '11':
            $mes = "Noviembre";
            break;        
        case '12':
            $mes = "Diciembre";
            break;            
    }
?>
    <main class="contenedor seccion">
        <h1>Consulta Individual</h1>
        <div class="botones">
            <a href="/admin/Casos/casos.php" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
        </div>
        <form action="" class="formulario">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="juzgado">Juzgado</label>
                <input disabled type="text" id="juzgado" name="juzgado" value="<?php echo $juzgado?>">

                <label for="materia">Materia</label>
                <input disabled type="text" id="materia" name="materia" value="<?php echo $materia;?>" >
                
                <label for="costo">Costo</label>
                <input disabled type="number" id="costo" name="costo" value="<?php echo $costo;?>">
            </fieldset>

            <fieldset>
                <legend>Fecha de Registro</legend>
                <label for="dia">Día</label>
                <select disabled name="dia" id="dia">
                    <option value="" selected disabled><?php echo $dia;?></option>
                </select>

                <label for="mes">Mes</label>
                <select disabled name="mes" id="mes">
                    <option value="" selected disabled><?php echo $mes;?></option>
                </select>

                <label for="anio">Año</label>
                <select disabled name="anio" id="anio">
                    <option value="" selected disabled><?php echo $anio;?></option>
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
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>