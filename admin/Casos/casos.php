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
    $query ='CALL consultaCasos("Activo");';
    $resultadoA = mysqli_query($db, $query);
    $query ='CALL consultaCasos("Archivado");';
    $db = conectarDB();
    $resultadoAr = mysqli_query($db, $query); 


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $act = $_POST['act'];
        $act2 = $_POST['act2'];
        $act3= $_POST['act3'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $act = filter_var($id, FILTER_VALIDATE_INT);
    
        if($id && $act){
            //Archiva Caso
            $db = conectarDB();
            $query = "CALL archivarCaso('$id')";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header('location: /admin/Casos/casos.php?resultado=3');
            }
        }
        if ($id && $act2) {
            //Archiva Caso
            $db = conectarDB();
            $query = "CALL eliminarCaso('$id')";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header('location: /admin/Casos/casos.php?resultado=4');
            }
        }

        if ($id && $act3) {
            //Archiva Caso
            $db = conectarDB();
            $query = "CALL activarCaso('$id')";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header('location: /admin/Casos/casos.php?resultado=5');
            }
        }
    }
?>

    <main class="contenedor seccion">
        <h1>Casos</h1>

        <?php if (intval($resultadoAccion) === 1): ?>
            <p class="alerta exito">Caso Agregado Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 2):?>
            <p class="alerta exito">Datos del Caso Actualizados Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 3):?>
            <p class="alerta exito">Caso Archivado Correctamente</p>     
        <?php elseif (intval($resultadoAccion) === 4):?>    
            <p class="alerta exito">Caso Eliminado Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 5):?>    
            <p class="alerta exito">Caso Activado Correctamente</p>
        <?php endif;?>

        <div class="acciones-casos">
            <a href="/admin" class="boton-azul">Volver</a>
            <a href="consultaIndividual.php" class="boton-azul">Consulta Individual</a>
            <a href="agregarCaso.php" class="boton-azul">Agregar Caso</a>
        </div>
    </main>
    <!--Tabla Casos Activos-->
    <h3>Casos Activos</h2>
    <table class="casos">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Abogado</th>
                <th>Juzgado</th>
                <th>Materia</th>
                <th>Costo</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while($caso = mysqli_fetch_assoc($resultadoA)):?>
            <tr>
                <td><?php echo $caso['Nom'].' '. $caso['ApeP']?></td>
                <td><?php echo $caso['NomE'].' '. $caso['ApePE']?></td>
                <td><?php echo $caso['Juzgado']?></td>
                <td><?php echo $caso['Materia']?></td>
                <td>$<?php echo $caso['Costo']?></td>
                <td><?php echo $caso['DiaR'].'/'.$caso['MesR'].'/'.$caso['AnioR'];?></td>
                <td>
                    <form action="" method="POST" class="w-100">
                        <input type="hidden" name="id" value = "<?php echo $caso['Id_NoExpediente'];?>">
                        <input type="hidden" name="act"value = "1">
                        <input type="submit" class="boton-rojo-block" value="Archivar">
                    </form>
                    <a href="/admin/Casos/actualizarCaso.php?id=<?php echo $caso['Id_NoExpediente'];?>" class="boton-verde-block" >Actualizar</a>
                    <a href="/admin/Casos/documentosCaso.php?id=<?php echo $caso['Id_NoExpediente'];?>" class="boton-azul-block" >Documentos</a>
                </td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    <!--Tabla Casos Archivados-->
    <h3>Casos Archivados</h2>
    <table class ="casos">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Abogado</th>
                <th>Juzgado</th>
                <th>Materia</th>
                <th>Costo</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while($caso = mysqli_fetch_assoc($resultadoAr)):?>
            <tr>
                <td><?php echo $caso['Nom'].' '. $caso['ApeP']?></td>
                <td><?php echo $caso['NomE'].' '. $caso['ApePE']?></td>
                <td><?php echo $caso['Juzgado']?></td>
                <td><?php echo $caso['Materia']?></td>
                <td>$<?php echo $caso['Costo']?></td>
                <td><?php echo $caso['DiaR'].'/'.$caso['MesR'].'/'.$caso['AnioR'];?></td>
                <td>
                    <form action="" method="POST" class="w-100">
                        <input type="hidden" name="id" value = "<?php echo $caso['Id_NoExpediente'];?>">
                        <input type="hidden" name="act2"value = "2">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <form action="" method="POST" class="w-100">
                        <input type="hidden" name="id" value = "<?php echo $caso['Id_NoExpediente'];?>">
                        <input type="hidden" name="act3"value = "1">
                        <input type="submit" class="boton-verde-block" value="Activar Caso">
                    </form>
                    <a href="/admin/Casos/documentosCaso.php?id=<?php echo $caso['Id_NoExpediente'];?>" class="boton-azul-block" >Documentos</a>
                </td>
            </tr>
            <?php endwhile;?>
        </tbody>            
    </table>

<?php inlcuirTemplate("footer");   ?>