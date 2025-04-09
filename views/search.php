<?php

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $role_id = $_SESSION['role_id'];
    if ($role_id == 1) {
        header("Location: ./report.php");
        exit();
    }
} else {
    header(header: "Location:../index.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles</title>
    <link rel="stylesheet" href="../css/style4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img height="70px" src="../assets/logo1.1.png"></a>
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
                            <button class="btn"> <a class="nav-link mx-lg-2 active " href="./favorite.php">Favoritos</a></button>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn type=" button" data-bs-toggle="dropdown">
                                    <a class="nav-link active" aria-current="page"> <img src="../assets/user.svg">
                                        <?php echo $name ?> (Usuario) </a>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>