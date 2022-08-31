<?php
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
    <link rel="stylesheet" type="text/css" href="xd.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

</head>
<body>
    <main class="contenedor seccion contenido-centrado">
        
        <form method="POST" class="formulario" novalidate>
            
            <h2>Iniciar Sesión</h2>
            <p>Siempre lo mejor para ti</p>
            

            <?php foreach ($errores as $error) : ?>
                <div class="alerta-error">
                    php echo $errores ?>
                </div>

            <?php endforeach ?>

            <div class="btn-inputs">
                <div class="campos">
                    <label for="email" class="etiquetas">E-mail</label>
                    <input type="email" name="mail" placeholder="Tu Email" id="email" class="inputs"></input>

                    <label for="pass" class="etiquetas">Password</label>
                    <input type="password" name="contra" placeholder="Tu Contraseña" id="password" class="inputs"></input>
                </div>
                
                <div class="enviar">
                    <input type="submit" value="Iniciar Sesión" class="boton-verde">

                    <a href="bienvenida.php">Registrarse</a>
                </div>
                
            </div>
            
        </form>
    </main>
</body>
</html>

