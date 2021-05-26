<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';
    
    $db = conectarDB();
    $query= "SELECT * FROM doccaso";
    $resultado = mysqli_query($db, $query);
    inlcuirTemplate("header");

?>
    <main class="contenedor seccion">
        <h1>Documentos</h1>
        <div class="acciones">
            <a href="/admin/Casos/agregarDocumento.php?id=1" class="boton-azul">Agregar Documento</a>
            <a href="/admin/Casos/casos.php"  class="boton-azul">Volver</a>
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
                        <form action="">
                            
                        </form>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </main>

<?php inlcuirTemplate("footer");   ?>