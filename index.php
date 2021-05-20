<?php 
//importar base de datos
require 'includes/config/database.php';
$db = conectarDB();

$errores=[];
//Autentificaccion de usuario
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    $email = mysqli_real_escape_string($db,filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db,$_POST['password']);

    if (!$email) {
        $errores[] = "El Correo  es obligatorio o no es valido";
    }

    if (!$password) {
        $errores[] = "La contraseña es obligatoria";
    }

    if (empty($errores)) {
        //revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email= '${email}' ";
        $resultado = mysqli_query($db, $query);
        if ($resultado->num_rows) {
            //revisar el password
            $usuario = mysqli_fetch_assoc($resultado);   
            //var_dump($usuario); 

            //verificar si el password es correcto o no 
            $auth = password_verify($password, $usuario['Password']);
            //var_dump($auth);
            if ($auth) {
                //Usuario Autentificado
                session_start();
                //llenar arreglo de sesion
                $_SESSION['usuario'] = $usuario['Email'];
                $_SESSION['login'] = true;

                //header('location: /admin');
            }
            else {
                $errores[] = 'La contraseña es incorrecta';
            }
        }
        else {
            $errores[] ="El ususario no existe";
        }
    }
}


require 'includes/funciones.php';
inlcuirTemplate("header"); 
?>

    <main class="contenedor seccion">
        <!--<h1>Gestor Juridico</h1>-->
        <h2>Iniciar Sesión</h2>

        <!--colocar errores si estos existen-->
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error;?>
            </div>
        <?php endforeach;?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Correo y Contraseña</legend>

                <label for="email">Correo</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Tu password" id="password" required>
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-azul">
        </form>
    </main>

<?php inlcuirTemplate("footer");   ?>
    
