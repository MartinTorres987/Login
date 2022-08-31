<?php
require 'database.php';
$db = conectarDB();

$errores = [];

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['mail'];
    $pass = $_POST['contra'];

        // Revisar si el usuario existe
        $query = "SELECT * FROM users WHERE mail = '${email}' ";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            // Verificar  si el password es correcto o no
            $auth = password_verify($pass, $usuario['contra']);

            if ($auth) {
                // El usuario esta autenticado
                session_start();

                // Llenar el arreglo de la sesión 
                $_SESSION['usuario'] = $usuario['mail'];
                $_SESSION['login'] = true;

                    header("Location: bienvenida.php");

                // ...
            } else {
                echo ('Contraseña incorrecta');
            }
        } else {
            echo ('Usuario no existe');
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./style.css" />
  <title>Document</title>
</head>

<body>
<main>
  <div class="contenedor__todo">
    <div class="caja__trasera">
      <div class="caja__trasera-login">
        <h3>¿Ya tienes una cuenta?</h3>
        <p>Iniciar sesión para entrar en la página</p>
        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
      </div>
      <div class="caja__trasera-register">
        <h3>¿Aún no tienes una cuenta?</h3>
        <p>Regístrate para entrar en la página</p>
          <button id="btn__register" href="index.php">Registrarse</button>
     
      </div>
    </div>
    <!--   Login y registro  -->
    <div class="contenedor__login-register">
      <form action="login.php" class="formulario__login formulario"  method="POST">
        <h2>Iniciar Sesión</h2>
        <input type="text" name="mail" placeholder="Correo Electronico"required >

        <input type="password" name="contra" placeholder="Contraseña"required>
        <button>Entrar</button>
      </form>

    </div>
  </div>
</main>
<script> src="xd.js"
</script>
</body>
</html>

