<?php 

require '../includes/funciones.php';
require '../includes/config/database.php';
$auth = estaAutenticado();

if (!$auth) {
    header('location: /');
}

$db = conectarDB();
$query = "SELECT Juzgado, Estatus, Nom, ApeP, Apem, Costo, Materia, DiaR, MesR, AnioR FROM Caso JOIN Clientes on Caso.Id_Clientes = Clientes.Id_Clientes;";
$resultado = mysqli_query($db, $query);

inlcuirTemplate("header"); 
?>
    <main class="contenedor seccion">
        <h1>Aministración</h1>
        <div class="contenedor admin">
            <div>
                <a href="" class="boton-azul-m w-100">Casos</a>
            </div>
            <div>
                <a href="" class="boton-azul-m w-100">Clientes</a>
            </div>
            <div>
                <a href="" class="boton-azul-m w-100">Empleados</a>
            </div>
        </div>

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
    </main>

<?php inlcuirTemplate("footer");   ?>