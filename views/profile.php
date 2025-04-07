<?php

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $role_id = $_SESSION['role_id'];
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($new_password) && $new_password !== $confirm_password) {
        $error_message = "Las contraseñas no coinciden.";
    } else {
        try {
            require_once '../backend/config.php';
            $dbConfig = new DbConfig();
            $db = $dbConfig->getConnection();

            if (!empty($current_password)) {
                // Verificar la contraseña actual
                $sql = "SELECT password FROM users WHERE id_users = :user_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result && password_verify($current_password, $result['password'])) {
                    // Actualizar los datos del usuario
                    $sql = "UPDATE users SET name = :name, last_name = :last_name, username = :username, email = :email";
                    if (!empty($new_password)) {
                        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                        $sql .= ", password = :password";
                    }
                    $sql .= " WHERE id_users = :user_id";

                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':email', $email);
                    if (!empty($new_password)) {
                        $stmt->bindParam(':password', $hashedPassword);
                    }
                    $stmt->bindParam(':user_id', $user_id);

                    $stmt->execute();

                    // Actualizar los datos en la sesión
                    $_SESSION['name'] = $name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;

                    // Establecer mensaje de éxito en la sesión
                    $_SESSION['success_message'] = "Perfil actualizado con éxito.";
                } else {
                    $error_message = "La contraseña actual es incorrecta.";
                }
            } else {
                // Actualizar los datos del usuario sin cambiar la contraseña
                $sql = "UPDATE users SET name = :name, last_name = :last_name, username = :username, email = :email WHERE id_users = :user_id";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':user_id', $user_id);

                $stmt->execute();

                // Actualizar los datos en la sesión
                $_SESSION['name'] = $name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                // Establecer mensaje de éxito en la sesión
                $_SESSION['success_message'] = "Perfil actualizado con éxito.";
            }
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}

// Mostrar mensaje de éxito si está establecido en la sesión
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Eliminar mensaje de la sesión después de mostrarlo
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="shortcut icon" href="../assets/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style3.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php"><img height="70px" src="../assets/logo1.1.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <button class="btn"><a class="nav-link mx-lg-2 active " href="./index.php">Inicio</a></button>
                        </li>
                        <li class="nav-item">
                            <button class="btn"> <a class="nav-link mx-lg-2 active " href="#">Favoritos</a></button>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn type=" button" data-bs-toggle="dropdown">
                                    <a class="nav-link active" aria-current="page"> <img src="../assets/user.svg">
                                        <?php echo $name ?> (Usuario) </a>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item link-danger" href="../backend/logout.php">Cerrar
                                            sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<br><br>
<div class="update update-form container">
    <div class="row align-items-center">
        <div class="profile-container col-md-6">
            <h2>Editar Perfil</h2>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="current_password" class="form-label">Contraseña Actual</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
        <div class="col-md-6">
            <img src="../assets/prueba.jpg" alt="Imagen de perfil" class="profile-image">
        </div>
    </div>
</div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>