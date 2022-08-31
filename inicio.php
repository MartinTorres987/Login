<?php
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./xd.css" />
</head>
<body>
    <div class="vid-container">
  <video id="Video1" class="bgvid back" autoplay="false" muted="muted" preload="auto" loop>
      <source src="http://shortcodelic1.manuelmasiacsasi.netdna-cdn.com/themes/geode/wp-content/uploads/2014/04/milky-way-river-1280hd.mp4.mp4" type="video/mp4">
  </video>
  <div class="inner-container">
    <video id="Video2" class="bgvid inner" autoplay="false" muted="muted" preload="auto" loop>
      <source src="http://shortcodelic1.manuelmasiacsasi.netdna-cdn.com/themes/geode/wp-content/uploads/2014/04/milky-way-river-1280hd.mp4.mp4" type="video/mp4">
    </video>
    <div class="box">
      <h1>Login</h1>
      <input type="text" placeholder="Username"/>
      <input type="text" placeholder="Password"/>
      <button>Login</button>
      <p>Not a member? <span>Sign Up</span></p>
    </div>
  </div>
</div>
</body>
</html>
