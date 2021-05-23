<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';

    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 

    $db = conectarDB();
    $query ="CALL consultaClientes();";
    $resultado = mysqli_query($db, $query);
?>


    <main class="contenedor seccion">
        <h1>Clientes</h1>
        <div class="botones">
            <a href="agregarCliente.php" class="boton-azul">Agregar Cliente</a>
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
                        <a href="/admin/propiedades/documentos.php?id=<?php echo $cliente['Id_Clientes'];?>" class="boton-azul-block" >Documentos</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>

<?php inlcuirTemplate("footer");   ?>