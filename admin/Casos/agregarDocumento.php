<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 
    $db = conectarDB();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //si id lo cambian regresa 
    if (!$id) {
        header('Location: /admin/Casos/documentosCaso.php');
    }
    //Posibles errores
    $errores =[];
    $nombreDocCaso='';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //echo "<pre>";
        //var_dump($_FILES);
        //echo "</pre>";
        $nombreDocCaso = mysqli_real_escape_string($db, $_POST['nomDoc']);
        $doc = $_FILES['doc'];
        

        if (!$doc) {
            $errores[] = 'Documento Obligatorio';
        }
        if (!$nombreDocCaso) {
            $errores[] = 'Nombre Obligatorio';
        }

        
        if (empty($errores)) {
            $carpetaDocCaso = '../../DocumentosCaso/';
            if (!is_dir($carpetaDocCaso)) {
                mkdir($carpetaDocCaso);
            }
            $extension = pathinfo($doc['name'], PATHINFO_EXTENSION);
            $nombreDocCaso = trim($nombreDocCaso);
            $nombreDocCaso = str_replace(" ", "", $nombreDocCaso);
            $docCaso = $nombreDocCaso.'.'.$extension;
            $query = "CALL agregarDocCaso('$id', '$docCaso','$nombreDocCaso');";
            $resultado = mysqli_query($db, $query);
            move_uploaded_file($doc['tmp_name'], $carpetaDocCaso.$docCaso);
            if ($resultado) {
                header("Location: /admin/Casos/documentosCaso.php?id=$id");
            }

        }
    }

?>
    <main class="contenedor seccion">
        <h1>Agregar Documento</h1>
        <a href="/admin/Casos/documentosCaso.php?id=<?php echo $id?>" class="boton-azul">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php        echo $error; ?>
            </div>
        <?php    endforeach;?>
        <form action="" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Documento</legend>
                <label for="nomDoc">Nombre Documento</label>
                <input type="text" name="nomDoc" id="nomDoc" value="<?php echo $nombreDocCaso;?>">    
                <label for="doc">Documento</label>
                <input type="file" name="doc" id="doc">
            </fieldset>
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>