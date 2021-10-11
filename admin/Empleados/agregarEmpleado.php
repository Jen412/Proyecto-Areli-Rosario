<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';
    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 
    //conexion de Base de Datos
    $db = conectarDB();

    //Posibles errores
    $errores =[];

    $nombre='';    
    $apeP='';
    $apeM='';
    $edad='';
    $sexo='';
    $curp='';
    $especialidad='';
    $ciudad='';
    $estado='';
    $calle='';
    $numCasa='';
    $colonia='';
    $telefono='';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre= mysqli_real_escape_string($db, $_POST['nombre']);
        $apeP= mysqli_real_escape_string($db, $_POST['apellidoP']);
        $apeM= mysqli_real_escape_string($db, $_POST['apellidoM']);
        $edad= mysqli_real_escape_string($db, $_POST['edad']);
        $sexo= mysqli_real_escape_string($db, $_POST['sexo']);
        $curp= mysqli_real_escape_string($db, $_POST['curp']);
        $especialidad= mysqli_real_escape_string($db, $_POST['especialidad']);
        $ciudad=mysqli_real_escape_string($db, $_POST['ciudad']);
        $estado=mysqli_real_escape_string($db, $_POST['estado']);
        $calle=mysqli_real_escape_string($db, $_POST['calle']);
        $numCasa=mysqli_real_escape_string($db, $_POST['numeroCasa']);
        $colonia=mysqli_real_escape_string($db, $_POST['colonia']);
        $telefono=mysqli_real_escape_string($db, $_POST['telefono']);
    
        if (!$nombre) {
            $errores[] = "Nombre Obligatorio";
        }

        if (!$apeM && !$apeP) {
            $errores[] = "Apellidos Oligatorios";
        }

        if (!$edad) {
            $errores[] = "Edad Obligatoria";
        }
        if ($edad > 100 && $edad <18) {
            $errores[] = "Edad no valida";
        }
        if (!$sexo) {
            $errores[] = "Sexo Indefinido";
        }
        if (!$curp) {
            $errores[] = "CURP Obligatoria";
        }

        if (!$especialidad) {
            $errores[] = "Ocupacion Especialidad";
        }

        if (!$calle && !$numCasa && !$colonia && !$ciudad && !$estado) {
            $errores[] = "Domicilio Obligatorio";
        }

        if (!$telefono) {
            $errores[] = "Telefono Obligatorio";
        }

        if (empty($errores)) {
            $query = "CALL agregarEmpleado('$nombre', '$apeP', '$apeM','$ciudad', '$estado', '$calle', '$numCasa', '$colonia',
            '$telefono', '$edad', '$curp', '$especialidad','$sexo');";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                //redireccionando al usuario
                header('Location: /admin/Empleados/empleados.php?resultado=1');
            }
        }
    }
?>
    <main class="contenedor seccion">
        <h1>Agregar Empleado</h1>

        <div class="botones">
            <a href="/admin/Empleados/empleados.php" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
        </div> 
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php        echo $error; ?>
            </div>
        <?php    endforeach;?>
        
        <form class="formulario" method="POST">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>">

                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno" value="<?php echo $apeP;?>">
                
                <label for="apellidoM">Apellido Materno</label>
                <input type="text" id="apellidoM" name="apellidoM" placeholder="Apellido Materno" value="<?php echo $apeM;?>">

                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" placeholder="Edad del cliente" min="18" max="100" value="<?php echo $edad;?>">

                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo">
                    <option value="" selected disabled>--Seleccione--</option>
                    <option value="M" <?php $r = ($sexo == "M") ? 'selected' : ''; echo $r;?>>Masculino</option>
                    <option value="F" <?php $r = ($sexo == "F") ? 'selected' : ''; echo $r;?>>Femenino</option>
                </select>

                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" placeholder="CURP del cliente" value="<?php echo $curp;?>">

                <label for="especialidad">Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" placeholder="Ocupación del empleado" value="<?php echo $especialidad?>">
            </fieldset>

            <fieldset>
            <legend>Domicilio</legend>
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad Ej: CD Guzman" value="<?php echo $ciudad;?>">

                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" placeholder="Estado Ej: Jalisco" value="<?php echo $estado;?>">

                <label for="calle">Calle</label>
                <input type="text" id="calle" name="calle" placeholder="Calle Ej: Donato Guerra" value="<?php echo $calle;?>">

                <label for="numeroCasa">Numero de Casa</label>
                <input type="number" id="numeroCasa" name="numeroCasa" placeholder="Numero de casa" value="<?php echo $numCasa;?>">

                <label for="colonia">Colonia</label>
                <input type="text" id="colonia" name="colonia" placeholder="Colonia Ej: Providencia" value="<?php echo $colonia;?>">
            </fieldset>    

            <fieldset>
            <legend>Contacto</legend>
                <label for="telefono">Telefono</label>
                <input type="number" id="telefono" name="telefono" placeholder="Telefono del cliente" maxlength="10" minlength="10" value="<?php echo $telefono;?>"> 
            </Fieldset> 
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php
    inlcuirTemplate("footer");   
    mysqli_close($db);
?>