<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 

    $db = conectarDB();
    $query ="CALL consEmpleados();";
    $resultado = mysqli_query($db, $query);
?>


    <main class="contenedor seccion">
        <h1>Empleados</h1>
        <div class="botones">
            <a href="agregarEmpleado.php" class="boton-azul">Agregar Empleado</a>
            <a href="/admin" class="boton-azul">Volver</a>
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
                <td><?php echo $empleado['Curp']?></td>
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