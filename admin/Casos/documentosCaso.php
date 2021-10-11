<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';
    
    $db = conectarDB();
    $resultadoAccion = $_GET['resultado'] ?? null;
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //si id lo cambian regresa 
    if (!$id) {
        header('Location: /admin/Casos/casos.php');
    }
    $query= "CALL consultaTodDocCaso('$id');";
    $resultado = mysqli_query($db, $query);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idDoc = $_POST['id'];
        $nomDoc =$_POST['nombreDoc'];
        $idDoc = filter_var($idDoc, FILTER_VALIDATE_INT);
        if($idDoc){
            //Elimina DocCaso de la raiz
            $db = conectarDB();
            $query ="CALL consultaDocCaso('$id', '$nomDoc')";
            $resultadoE = mysqli_query($db,$query);
            $documento = mysqli_fetch_assoc($resultadoE);
            $carpetaDocCaso = '../../DocumentosCaso/';
            unlink($carpetaDocCaso.$documento['URL_Doc']);
            //Elimina DocCaso
            $db = conectarDB();
            $query = "CALL EliminarDocCaso('$idDoc','$nomDoc')";
            $resultadoE = mysqli_query($db, $query);
            if ($resultadoE) {
                header("Location: /admin/Casos/documentosCaso.php?id=$id&resultado=3");
            }
        }
    }
    inlcuirTemplate("header");

?>
    <main class="contenedor seccion">
        <h1>Documentos</h1>

        <?php if (intval($resultadoAccion) === 1): ?>
            <p class="alerta exito">Documento Agregado Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 2):?>
            <p class="alerta exito">Documento Eliminado Correctamente</p>     
        <?php endif;?>

        <div class="acciones botones">
            <a href="/admin/Casos/casos.php" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
            <a href="/admin/Casos/agregarDocumento.php?id=<?php echo $id?>" class="boton-azul icono">
                <ion-icon name="add-circle-outline" class="size3"></ion-icon> 
                Agregar Documento
            </a>
        </div>
        <table class="documentos">
            <thead>
                <tr>
                    <th>Nombre del Documento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($doc = mysqli_fetch_assoc($resultado)):?>
                <tr>
                    <td><?php echo $doc['Nombre_Doc']?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value = "<?php echo $doc['Id_DocCaso'];?>">
                            <input type="hidden" name="nombreDoc" value="<?php echo$doc['Nombre_Doc'];?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/DocumentosCaso/<?php echo $doc['URL_Doc'];?>" download="<?php echo $doc['URL_Doc'];?>" class="boton-verde-block">Descargar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php inlcuirTemplate("footer");   ?>