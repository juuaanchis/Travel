<?php

session_start();


$servername = "localhost";
$username = "root";
$password = ""; 
$database = "reserva";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_users, name, last_name, username, email FROM users";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../assets/icon.png">
</head>

<body>

    <div class="login">
        <form id="signupForm" method="POST" action="../backend/register.php" class="form_container" >
            <img src="../assets/logo1.1.png" alt="" class="logo_container">
            <div class="title_container">
                <p class="title">Crea una cuenta</p>
                <span class="subtitle">Registrate en Travel y disfruta de la gran experiencia en nuestra página
                    web.</span>
            </div>
            <br>
            <div class="input_container">
                <label class="input_label" for="name_field">Nombres</label>
                <img src="../assets/face.svg" class="icon">
                <input placeholder="Nombres" title="Input title" name="name" type="text" class="input_field">
            </div>
            <div class="input_container">
                <label class="input_label" for="last_name_field">Apellidos</label>
                <img src="../assets/face.svg" class="icon">
                <input placeholder="Apellidos" title="Input title" name="last_name" type="text" class="input_field">
            </div>
            <div class="input_container">
                <label class="input_label" for="username_field">Nombre de usuario</label>
                <img src="../assets/tag.svg" class="icon">
                <input placeholder="nombre de usuario" title="Input title" name="username" type="text"
                    class="input_field">
            </div>
            <div class="input_container">
                <label class="input_label" for="email_field">Email</label>
                <img src="../assets/email.svg" class="icon">
                <input placeholder="miguel@ejemplo.com" title="Input title" name="email" type="text" class="input_field"
                    id="email_field">
            </div>
            <div class="input_container">
                <label class="input_label" for="password_field">Contraseña</label>
                <img src="../assets/password.svg" class="icon">
                <input placeholder="Contraseña" title="Input title" name="password" type="password" class="input_field"
                    id="password_field">
            </div>
           
            <button type="submit" class="butt sign-in_btn">
                <span>Registrarse</span>
            </button>
            <p class="span">¿Ya tienes una cuenta? <a href="../index.html" class="span">Inicia sesión</a></p>
        </form>


    </div>

</body>

</html>