<?php
require 'database.php';
$db = conectarDB();

$error = "";

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $mail = $_POST['mail'];
    $contra = $_POST['contra'];

    $contraseñaSegura = password_hash($contra, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nombre, apellido, mail, contra) VALUES ('$name','$apellido','$mail','${contraseñaSegura}')";

    $resultado = mysqli_query($db, $sql);

    if ($resultado) {
        header("Location: bienvenida.php");
    }else{
        $error = "No se logró registrarte";
    }
}

?>

<!DOCTYPE html>
<html>
<body>
<head>
    <title>Registrar Usuario</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="xd.css">
</head>
</body>
    



    <main class="contenedor seccion contenido-centrado">
        
        <form method="POST" class="formulario" id="nombre" novalidate action="index.php">
            
            <h2>Registrarse</h2>
            <p>Empieza por lo mejor para ti</p>
            

            <?php foreach ($errores as $error) : ?>
                <div class="alerta-error">
                    php echo $error ?>
                </div>

            <?php endforeach ?>

            <div class="btn-inputs">

                <div class="campos">
                    
                    <div class="div">
                        <label for="email" class="etiquetas">Tu nombre</label>
                        <input type="text" name="nombre" require placeholder="Nombre" class="inputs" required>

                        <label for="pass" class="etiquetas">Tu Apellido</label>
                        <input type="text" name="apellido" require placeholder="Apellidos" class="inputs" required>
                    </div>
                    
                    <div class="div">
                        <label for="pass" class="etiquetas">Ingresa tu correo</label>
                        <input type="email" name="mail"  require placeholder="correo" class="inputs" required>

                        <label for="pass" class="etiquetas">Crea una contraseña</label>
                        <input type="password" name="contra" require placeholder="Contraseña" class="inputs" required>
                    </div>
                    
                </div>
                
                <div class="enviar">
                    <input type="submit" value="Registrarse" class="boton-verde">

                    <a href="bienvenida.php">¿Ya tienes una cuenta?</a>
                </div>
                
            </div>
            
        </form>
    </main>
</div>  


</html>