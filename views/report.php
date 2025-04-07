<?php

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $role_id = $_SESSION['role_id'];

    if ($role_id != 1) {
        header("Location: ./index.php");
        exit();
    }
} else {
    header(header: "Location:../index.html");
    exit();
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <title>Document</title>
    <link rel="shortcut icon" href="../assets/icon.png">
</head>

<body>

    <style>
    .navbar {
        box-shadow: 0px 50px 20px rgba(0, 0, 0, 0.01),
            0px 20px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.09),
            0px 7px 15px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
    }

    .navbar-toggler {
        border: none;
        font-size: 1.25rem;
    }

    .navbar-toggler:focus,
    .btn-close:focus {
        box-shadow: none;
        outline: none;
    }

    .nav-link {
        color: #666777;
        font-weight: 500;

    }

    .nav-link:hover,
    .nav-link.active {
        color: #000;
    }

    .nav-link::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background-color: #009970;
        visibility: hidden;
        transition: 0.3s ease-in-out;

    }

    .nav-link:hover::before,
    .nav-link:active::before {
        width: 100%;
        visibility: visible;
    }
    </style>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">

            <img width="70px" src="../assets/logo1.2.png" alt="">
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
                            <button class="btn" type="button"><a class="nav-link mx-lg-2 " href="#">Inicio</a></button>
                        </li>
                        <li class="nav-item">
                            <button class="btn" type="button"><a class="nav-link mx-lg-2 "
                                    href="#">Favoritos</a></button>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn type=" button" data-bs-toggle="dropdown">
                                    <a class="nav-link active" aria-current="page"> <img src="../assets/user.svg"
                                            alt=""> <?php echo $name ?> (Admin) </a>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="./profile.php">Administrar perfil</a></li>
                                    <li><a class="dropdown-item link-danger" href=" ../backend/logout.php">Cerrar
                                            sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <br><br><br><br><br>
        <div class="container mt-5 pt-5">
            <h2 class="text-center">Lista de Usuarios</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Usuario</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['id_users']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['last_name']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['email']}</td>
                                  </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No hay datos disponibles</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>