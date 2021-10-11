<?php 

require '../includes/funciones.php';
require '../includes/config/database.php';
$auth = estaAutenticado();

if (!$auth) {
    header('location: /');
}

inlcuirTemplate("header"); 

$db = conectarDB();
$query = "CALL consultaCasosXClientes();";
$resultado = mysqli_query($db, $query);


?>
    <main class="contenedor seccion">
        <h1>Administración</h1>
        <div class="contenedor admin">
            <div>
                <a href="/admin/Casos/casos.php" class="boton-azul-m w-100 icono">
                    <ion-icon name="folder-outline"></ion-icon>
                    Caso
                </a>
            </div>
            <div>
                <a href="/admin/Clientes/clientes.php" class="boton-azul-m w-100 icono">
                    <ion-icon name="people-circle-outline"></ion-icon>
                    Clientes
                </a>
            </div>
            <div>
                <a href="/admin/Empleados/empleados.php" class="boton-azul-m w-100 icono">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    Empleados
                </a>
            </div>
        </div>


    </main>

    <table class="casos">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Juzgado</th>
                    <th>Materia</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                </tr> 
            </thead>

            <tbody>
                <?php while ($caso = mysqli_fetch_assoc($resultado)):?>
                <tr>
                    <td><?php echo $caso['Nom'].' '.$caso['ApeP'].' '.$caso['Apem'];?></td>
                    <td><?php echo $caso['Juzgado'];?></td>
                    <td><?php echo $caso['Materia'];?></td>
                    <td><?php echo '$'.$caso['Costo'];?></td>
                    <td><?php echo $caso['DiaR'].'/'.$caso['MesR'].'/'.$caso['AnioR'];?></td>
                    <td><?php echo $caso['Estatus'];?></td>
                </tr>
                <?php endwhile;?>
            </tbody>

        </table>
<?php 
    inlcuirTemplate("footer");   
    mysqli_close($db);
?>