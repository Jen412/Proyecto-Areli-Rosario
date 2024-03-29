<?php 
    require '../../includes/funciones.php';
    require '../../includes/config/database.php';
    $auth = estaAutenticado();
    if (!$auth) {
        header('location: /');
    }
    inlcuirTemplate("header"); 
    //obtiene el id de la URL
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    //si id lo cambian regresa 
    if (!$id) {
        header('Location: /admin/Clientes');
    }
    //Conexion de Base de Datos
    $db= conectarDB();    
    //Consulta para obtener Clientes
    $query ="CALL consultaCli('$id')";
    $resultado = mysqli_query($db, $query);
    $cliente= mysqli_fetch_assoc($resultado);

    //Posibles Errores
    $errores = [];

    $nombre=$cliente['Nom'];
    $apeP=$cliente['ApeP'];
    $apeM=$cliente['ApeM'];
    $edad=$cliente['Edad'];
    $sexo=$cliente['Sexo'];
    $curp=$cliente['CURP'];
    $ocupacion=$cliente['Ocupacion'];
    $dia =$cliente['diaN'];
    $mes=$cliente['MesN'];
    $anio=$cliente['AnioN'];
    $ciudad=$cliente['Ciudad'];
    $estado=$cliente['Estado'];
    $calle=$cliente['Calle'];
    $numCasa=$cliente['NumCasa'];
    $colonia=$cliente['Colonia'];
    $email =$cliente['Email'];
    $telefono=$cliente['Telefono'];
    //Ejecuta codigo despues de precionar el boton de enviar
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($cliente);
        // echo "</pre>";
        
        $nombre= mysqli_real_escape_string($db, $_POST['nombre']);
        $apeP= mysqli_real_escape_string($db, $_POST['apellidoP']);
        $apeM= mysqli_real_escape_string($db, $_POST['apellidoM']);
        $sexo= mysqli_real_escape_string($db, $_POST['sexo']);
        $curp= mysqli_real_escape_string($db, $_POST['curp']);
        $ocupacion= mysqli_real_escape_string($db, $_POST['ocupacion']);
        $dia =mysqli_real_escape_string($db, $_POST['dia']);
        $mes= mysqli_real_escape_string($db, $_POST['mes']);
        $anio= mysqli_real_escape_string($db, $_POST['anio']);
        $ciudad=mysqli_real_escape_string($db, $_POST['ciudad']);
        $estado=mysqli_real_escape_string($db, $_POST['estado']);
        $calle=mysqli_real_escape_string($db, $_POST['calle']);
        $numCasa=mysqli_real_escape_string($db, $_POST['numeroCasa']);
        $colonia=mysqli_real_escape_string($db, $_POST['colonia']);
        $email =mysqli_real_escape_string($db, $_POST['email']);
        $telefono=mysqli_real_escape_string($db, $_POST['telefono']);

        $ine = $_FILES['ine'];
        $acta = $_FILES['acta'];
        $com = $_FILES['com'];

        if (!$nombre) {
            $errores[] = "Nombre Obligatorio";
        }

        if (!$apeM && !$apeP) {
            $errores[] = "Apellidos Oligatorios";
        }

        if (!$sexo) {
            $errores[] = "Sexo Indefinido";
        }
        if (!$curp) {
            $errores[] = "CURP Obligatoria";
        }

        if (!$ocupacion) {
            $errores[] = "Ocupacion Obligatoria";
        }

        if (!$dia && !$mes && !$anio) {
            $errores[] = "Fecha de Nacimiento Obligatoria";
        }

        if (!$calle && !$numCasa && !$colonia && !$ciudad && !$estado) {
            $errores[] = "Domicilio Obligatorio";
        }

        if (!$email) {
            $errores[] = "Email Obligatorio";
        }

        if (!$telefono) {
            $errores[] = "Telefono Obligatorio";
        }

        //Ejecutar actualizar mientras no tenga errores
        if (empty($errores)) {
            $query = "CALL consultaDocCliente('$id');";
            $db = conectarDB();
            $resultado = mysqli_query($db, $query);
            $docs = mysqli_fetch_assoc($resultado);

            $carpetaDocumentos = '../../DocumentosCliente/';
            if (!is_dir($carpetaDocumentos)) {
                mkdir($carpetaDocumentos);
            }

            $nombreIne = "";
            $nombreActa = "";
            $nombreCom = "";

            //Calculo de edad 
            $fechaNacimiento = new DateTime($anio."-".$mes."-".$dia);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento);
            
            if ($ine['name']) {
                //Elimina el archivo de la Carpeta
                unlink($carpetaDocumentos.$docs['Doc_INE']);
                //agrega el nuevo nombre del archivo
                $nombreIne = $ine['name'];
                //agrega el nuevo archivo
                move_uploaded_file($ine['tmp_name'], $carpetaDocumentos . $nombreIne);
            }
            else{
                $nombreIne =$docs['Doc_INE'];
            }
            
            if ($com['name']) {
                //Elimina el archivo de la Carpeta
                unlink($carpetaDocumentos.$docs['Doc_ComDom']);
                //agrega el nuevo nombre del archivo
                $nombreCom = $com['name'];
                //agrega el nuevo archivo
                move_uploaded_file($com['tmp_name'], $carpetaDocumentos . $nombreCom);
            }
            else {
                $nombreCom =$docs['Doc_ComDom'];
            }

            if ($acta['name']) {
                //Elimina el archivo de la Carpeta
                unlink($carpetaDocumentos.$docs['Doc_ActaN']);
                //agrega el nuevo nombre del archivo
                $nombreActa = $acta['name'];
                //agrega el nuevo archivo
                move_uploaded_file($acta['tmp_name'], $carpetaDocumentos . $nombreActa);
            }
            else{
                $nombreActa = $docs['Doc_ActaN'];
            }

            //Actualiza la base de datos
            //Actualiza tabla clientes
            $db = conectarDB();
            $query = "CALL modificarClientes('$nombre', '$apeP', '$apeM', '$ciudad', '$estado','$calle', '$numCasa', '$colonia', '$email',
            '$telefono', '$edad->y', '$curp','$ocupacion', '$sexo', '$dia', '$mes', '$anio', '$id');";
            $resultado = mysqli_query($db, $query);
            //Actualiza tabla docClientes
            $db = conectarDB();
            $idDoc = $docs['Id_DocCliente'];
            $query = "CALL modificarDocClientes('$idDoc','$nombreCom','$nombreIne','$nombreActa');";
            $resultado =mysqli_query($db, $query);

            if ($resultado) {
                //redireccionando al usuario
                header('Location: /admin/Clientes/clientes.php?resultado=2');
            }
        }
    }


?>
    <main class="contenedor seccion">
        <h1>Actualizar Cliente</h1>
        <div class="botones">
            <a href="/admin/Clientes/clientes.php" class="boton-azul icono">
                <ion-icon name="arrow-undo-outline" class="size3"></ion-icon>
                Volver
            </a>
        </div>
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php        echo $error; ?>
            </div>
        <?php    endforeach;?>
        
        <form  class="formulario" method="POST" enctype="multipart/form-data">
            <Fieldset>
                <Legend>Datos Principales</Legend>
                
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>">

                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno" value="<?php echo $apeP;?>">
                
                <label for="apellidoM">Apellido Materno</label>
                <input type="text" id="apellidoM" name="apellidoM" placeholder="Apellido Materno" value="<?php echo $apeM;?>">

                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo">
                    <option value="" selected disabled>--Seleccione--</option>
                        <option value="M" <?php $r = ($sexo == "M") ? 'selected' : ''; echo $r;?>>Masculino</option>
                        <option value="F" <?php $r = ($sexo == "F") ? 'selected' : ''; echo $r;?>>Femenino</option>
                </select>

                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" placeholder="CURP del cliente" value="<?php echo $curp;?>">

                <label for="ocupacion">Ocupación</label>
                <input type="text" id="ocupacion" name="ocupacion" placeholder="Ocupación del cliente ej: Arquitecto" value="<?php echo $ocupacion;?>">
            </fieldset>

            <fieldset>
                <legend>Fecha de nacimiento</legend>
                <label for="dia">Día</label>
                <input type="hidden" id="diaR" value="<?php echo $dia;?>">
                <select name="dia" id="dia">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>

                <label for="mes">Mes</label>
                <input type="hidden" id="mesR" value="<?php echo $mes;?>">
                <select name="mes" id="mes">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>

                <label for="anio">Año</label>
                <input type="hidden" id="anioR" value="<?php echo $anio;?>">
                <select name="anio" id="anio">
                    <option value="" selected disabled>--Seleccione--</option>
                </select>
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
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email;?>">

                <label for="telefono">Telefono</label>
                <input type="number" id="telefono" name="telefono" placeholder="Telefono del cliente" maxlength="10" minlength="10" value="<?php echo $telefono;?>"> 
            </Fieldset>

            <fieldset>
                <legend>Documentos</legend>
                <label for="ine">INE</label>
                <input type="file" name="ine" id="ine" accept="application/pdf">

                <label for="com">Comprobante de Domicilio</label >
                <input type="file" name="com" id="com" accept="application/pdf">

                <label for="acta">Acta de Nacimiento</label>
                <input type="file" name="acta" id="acta"accept="application/pdf" >                
            </fieldset>
            
            <input type="submit" class="boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>