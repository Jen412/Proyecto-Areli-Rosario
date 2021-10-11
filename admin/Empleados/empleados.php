<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

    $resultadoAccion = $_GET['resultado'] ?? null;

    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 

    $db = conectarDB();
    $query ="CALL consultaEmpleados();";
    $resultado = mysqli_query($db, $query);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if($id){
            //Archiva Caso
            $db = conectarDB();
            $query = "CALL eliminarEmpleado('$id')";
            $resultadoE = mysqli_query($db, $query);
            if ($resultadoE) {
                header('location: /admin/Empleados/empleados.php?resultado=3');
            }
        }
    }    
?>


    <main class="contenedor seccion">
        <h1>Empleados</h1>
        <?php if (intval($resultadoAccion) === 1): ?>
            <p class="alerta exito">Empleado Agregado Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 2):?>
            <p class="alerta exito">Datos del Empleado Actualizados Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 3):?>
            <p class="alerta exito">Empleado Eliminado Correctamente</p>     
        <?php endif;?>

        <div class="botones">
            <a href="/admin" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
            <a href="agregarEmpleado.php" class="boton-azul icono">
                <ion-icon name="add-circle-outline" class="size3"></ion-icon>     
                Agregar Empleado
            </a>
        </div>
    </main>    
    <table class="clientes">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Domicilio</th>
                <th>Telefono</th>
                <th>CURP</th>
                <th>Especialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($empleado = mysqli_fetch_assoc($resultado)):?>
            <tr>
                <td><?php echo $empleado['Nom'] .' '.$empleado['ApeP'].' '.$empleado['ApeM'];?></td>
                <td><?php echo $empleado['Ciudad'];?></td>
                <td><?php echo $empleado['Estado'];?></td>
                <td><?php echo $empleado['Calle'].' '.'#'.$empleado['NumCasa'].' '.$empleado['Colonia'];?></td>
                <td><?php echo $empleado['Telefono']?></td>
                <td><?php echo $empleado['CURP']?></td>
                <td><?php echo $empleado['Especialidad']?></td>
                <td>
                    <form action="" method="POST" class="w-100">
                        <input type="hidden" name="id" value = "<?php echo $empleado['Id_NoEmpleado'];?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/Empleados/actualizarEmpleados.php?id=<?php echo $empleado['Id_NoEmpleado'];?>" class="boton-verde-block" >Actualizar</a>
                </td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>

<?php inlcuirTemplate('footer');  ?>