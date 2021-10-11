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
    $query= "CALL consultaDocCliente('$id');";
    $resultado = mysqli_query($db, $query);
    $doc = mysqli_fetch_assoc($resultado);

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $idDoc = $_POST['id'];
    //     $nomDoc =$_POST['nombreDoc'];
    //     $idDoc = filter_var($idDoc, FILTER_VALIDATE_INT);
    //     if($idDoc){
    //         //Elimina DocCaso de la raiz
    //         $db = conectarDB();
    //         $query ="CALL consultaDocCliente('$id', '$nomDoc')";
    //         $resultadoE = mysqli_query($db,$query);
    //         $documento = mysqli_fetch_assoc($resultadoE);
    //     }
    // }
    inlcuirTemplate("header");

?>
    <main class="contenedor seccion">
        <h1>Documentos</h1>
        <div class="acciones">
            <a href="/admin/Clientes/clientes.php"  class="boton-azul">Volver</a>
        </div>
        <table class="documentos">
            <thead>
                <tr>
                    <th>Nombre del Documento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $doc['Doc_ActaN']?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="nombreDoc" value="<?php echo$doc['Doc_ActaN'];?>">
                        </form>
                        <a href="/DocumentosCliente/<?php echo $doc['Doc_ActaN'];?>" download="<?php echo $doc['Doc_ActaN'];?>" class="boton-verde-block">Descargar</a>
                    </td>
                </tr>
                <tr>
                <td><?php echo $doc['Doc_INE']?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="nombreDoc" value="<?php echo$doc['Doc_INE'];?>">
                        </form>
                        <a href="/DocumentosCliente/<?php echo $doc['Doc_INE'];?>" download="<?php echo $doc['Doc_INE'];?>" class="boton-verde-block">Descargar</a>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $doc['Doc_ComDom']?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="nombreDoc" value="<?php echo$doc['Doc_ComDom'];?>">
                        </form>
                        <a href="/DocumentosCliente/<?php echo $doc['Doc_ComDom'];?>" download="<?php echo $doc['Doc_ComDom'];?>" class="boton-verde-block">Descargar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

<?php inlcuirTemplate("footer");   ?>