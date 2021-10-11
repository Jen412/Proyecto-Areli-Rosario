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
    $query ="CALL consultaClientes();";
    $resultado = mysqli_query($db, $query);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if($id){
            //consulta el id de Doc cliente
            $db = conectarDB();
            $query="call consultaDocCliente('$id')";
            $resultadoE= mysqli_query($db, $query);
            $doc = mysqli_fetch_assoc($resultadoE);
            $idDoc = $doc['Id_DocCliente'];
            //Elimina Doc cliente
            $db = conectarDB();
            $query="call eliminarDocCliente('$idDoc')";
            $resultadoE= mysqli_query($db, $query);
            $carpetaDocumentos = '../../DocumentosCliente/';
            //elimina archivos de la raiz
            unlink($carpetaDocumentos.$doc['Doc_ComDom']);
            unlink($carpetaDocumentos.$doc['Doc_ActaN']);
            unlink($carpetaDocumentos.$doc['Doc_INE']);

            //Elimina Cliente
            $db = conectarDB();
            $query = "CALL eliminarCliente('$id');";
            $resultadoE = mysqli_query($db, $query);
            var_dump($resultadoE);
            exit;
            if ($resultadoE) {
                header('location: /admin/Clientes/Clientes.php?resultado=3');
            }
        }
    }
?>

    <main class="contenedor seccion">
        <h1>Clientes</h1>
        <?php if (intval($resultadoAccion) === 1): ?>
            <p class="alerta exito">Cliente Agregado Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 2):?>
            <p class="alerta exito">Datos del Cliente Actualizados Correctamente</p>
        <?php elseif (intval($resultadoAccion) === 3):?>
            <p class="alerta exito">Cliente Eliminado Correctamente</p>    
        <?php endif;?>

        <div class="botones">
            <a href="/admin" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
            <a href="agregarCliente.php" class="boton-azul icono">
                <ion-icon name="add-circle-outline" class="size3"></ion-icon>    
                Agregar Cliente
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
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>CURP</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($cliente = mysqli_fetch_assoc($resultado)):?>
                <tr>
                    <td><?php echo $cliente['Nom'] .' '.$cliente['ApeP'].' '.$cliente['ApeM'];?></td>
                    <td><?php echo $cliente['Ciudad'];?></td>
                    <td><?php echo $cliente['Estado'];?></td>
                    <td><?php echo $cliente['Calle'].' '.'#'.$cliente['NumCasa'].' '.$cliente['Colonia'];?></td>
                    <td><?php echo $cliente['Email']?></td>
                    <td><?php echo $cliente['Telefono']?></td>
                    <td><?php echo $cliente['Curp']?></td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value = "<?php echo $cliente['Id_Clientes'];?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/Clientes/actualizarCliente.php?id=<?php echo $cliente['Id_Clientes'];?>" class="boton-verde-block" >Actualizar</a>
                        <a href="/admin/Clientes/documentosCliente.php?id=<?php echo $cliente['Id_Clientes'];?>" class="boton-azul-block" >Documentos</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>

<?php inlcuirTemplate("footer");   ?>