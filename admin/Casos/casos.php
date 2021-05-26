<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

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
?>

    <main class="contenedor seccion">
        <h1>Casos</h1>
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
                        <input type="submit" class="boton-rojo-block" value="Archivar">
                    </form>
                    <a href="/admin/Clientes/actualizarCliente.php?id=<?php echo $caso['Id_NoExpediente'];?>" class="boton-verde-block" >Actualizar</a>
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
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/Clientes/actualizarCliente.php?id=<?php echo $caso['Id_NoExpediente'];?>" class="boton-verde-block" >Activar Caso</a>
                    <a href="/admin/Casos/documentosCaso.php?id=<?php echo $caso['Id_NoExpediente'];?>" class="boton-azul-block" >Documentos</a>
                </td>
            </tr>
            <?php endwhile;?>
        </tbody>            
    </table>

<?php inlcuirTemplate("footer");   ?>