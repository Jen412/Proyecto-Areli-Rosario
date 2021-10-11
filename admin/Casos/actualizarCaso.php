<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
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

    //Posibles errores
    $errores =[];

    $juzgado = $caso['Juzgado'];
    $estatus = $caso['Estatus'];
    $materia = $caso['Materia'];
    $costo = $caso['Costo'];
    $dia = $caso['DiaR']; 
    $mes = $caso['MesR'];
    $anio = $caso['AnioR'];
    $clienteId = $caso['Id_Clientes'];
    $empleadoId = $caso['Id_NoEmpleado'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $juzgado =mysqli_real_escape_string($db, $_POST['juzgado']);
        $materia = mysqli_real_escape_string($db, $_POST['materia']);
        $costo = mysqli_real_escape_string($db, $_POST['costo']);
        $dia = mysqli_real_escape_string($db, $_POST['dia']); 
        $mes=mysqli_real_escape_string($db, $_POST['mes']);
        $anio=mysqli_real_escape_string($db, $_POST['anio']);
        $clienteId =mysqli_real_escape_string($db, $_POST['cliente']);
        $empleadoId =mysqli_real_escape_string($db, $_POST['abogado']);
        
        if (!$juzgado) {
            $errores[] = 'Juzgado Obligatorio';
        }

        if (!$materia) {
            $errores[] = 'Materia Oligatorio';
        }

        if (!$costo) {
            $errores[] = 'Costo Oligatorio';
        }

        if (!$dia && !$mes && !$anio) {
            $errores[] = "Fecha de Registro Obligatoria";
        }

        if (!$clienteId) {
            $errores[]="Escoger Cliente es obligatorio";
        }

        if (!$empleadoId) {
            $errores[]="Escoger Abogado es obligatorio";
        }

        if (empty($errores)) {
            $query = "CALL modificarCaso('$id', '$juzgado', '$estatus', '$materia', '$costo', '$dia', '$mes', '$anio', '$clienteId', '$empleadoId');";
            $db = conectarDB();
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //redireccionando al usuario
                header('Location: /admin/Casos/casos.php?resultado=2');
            }
        }
    }

?>
    <main class="contenedor seccion">
        <h1>Actualizar Caso</h1>
        <div class="botones">
        <a href="/admin/Casos/casos.php" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
        </div>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php  echo $error; ?>
            </div>
        <?php    endforeach;?>

        <form  class="formulario" method="POST">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="juzgado">Juzgado</label>
                <input type="text" id="juzgado" name="juzgado" placeholder="Juzgado" value="<?php echo $juzgado;?>">

                <label for="materia">Materia</label>
                <input type="text" id="materia" name="materia" placeholder="Materia" value="<?php echo $materia;?>">
                
                <label for="costo">Costo</label>
                <input type="number" id="costo" name="costo" placeholder="Costo" value="<?php echo $costo;?>">
            </fieldset>

            <fieldset>
                <legend>Fecha de Registro</legend>
                <label for="dia">Día</label>
                <input type="hidden" id="diaR" value="<?php echo $dia;?>">
                <select name="dia" id="dia">
                    <option value="0" selected disabled>--Seleccione--</option>
                </select>

                <label for="mes">Mes</label>
                <input type="hidden" id="mesR" value="<?php echo $mes;?>">
                <select name="mes" id="mes">
                    <option value="0" selected disabled>--Seleccione--</option>
                </select>

                <label for="anio">Año</label>
                <input type="hidden" id="anioR" value="<?php echo $anio;?>">
                <select name="anio" id="anio">
                    <option value="0" selected disabled>--Seleccione--</option>
                </select>
            </fieldset>
   
            <fieldset>
                <legend>Cliente y Abogado</legend>
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
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer"); 
      mysqli_close($db);
?>