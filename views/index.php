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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="shortcut icon" href="../assets/icon.png">
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
                            <button class="btn"><a class="nav-link mx-lg-2 active " href="#">Inicio</a></button>
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
    </nav><br><br><br><br>
    <div class="contenido">
        <div class="filtro">
            <h1>Bienvenido a Travel</h1>
            <p>Haz tu reserva a donde viajes.</p>
            <div class="buscar">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Destino" list="locations">
                    <span class="input-group-text"><img src="../assets/ubicacion.svg" alt="Ubicación"
                            width="20px"></span>
                    <datalist id="locations">
                        <option value="Bogotá, Colombia">
                        <option value="Medellín, Colombia">
                        <option value="Cartagena, Colombia">
                        <option value="Punta Cana, República Dominicana">
                        <option value="Cancún, México">
                        <option value="Miami, Estados Unidos">
                    </datalist>
                </div>
                <div class="input-group">
                    <input type="date" class="form-control">
                    <span class="input-group-text"><img src="../assets/fecha.svg" alt="Fecha" width="20px"></span>
                </div>
                <div class="input-group">
                    <input type="date" class="form-control" placeholder="Fecha secundaria">
                    <span class="input-group-text"><img src="../assets/fecha.svg" alt="Fecha secundaria"
                            width="20px"></span>
                </div>
                <div class="input-group">
                    <input type="number" class="form-control" value="1" min="1">
                    <span class="input-group-text"><img src="../assets/persona.svg" alt="Personas" width="20px"></span>
                </div>
                <a href="./search.php"> <button type="button" class="btn btn-primary"> <img src="../assets/buscar.png"
                            width="20px">
                        Buscar</button></a>
            </div>
            <p>Busca ofertas de hoteles en muchos sitios como estos:</p>
            <div class="agencias">
                <img src="../assets/booking.png"><img src="../assets/expedia.png"><img src="../assets/hoteles.png"><img
                    src="../assets/priceline.png"><img src="../assets/agoda.png"><img src="../assets/hilton.png">
            </div>
        </div>
    </div>
    <div class="contenido">
        <div class="ofertas">
            <h2>Excelentes ofertas del momento</h2>
            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img width="250px" src="../assets/hotel1.png" class="card-img-top" alt="Oferta 1">
                        <div class="card-body">
                            <h5 class="card-title">Hotel tequendama</h5>
                            <p class="card-text">Bogotá, Colombia</p>
                            <div class="precio">
                                <h5>$304.067</h5>
                                <p>Por noche</p>
                            </div>
                            <a href="./detail.php" class="btn btn-primary w-100">Consultar oferta</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img width="250px" src="../assets/hotel2.png" class="card-img-top" alt="Oferta 2">
                        <div class="card-body">
                            <h5 class="card-title">Hotel Dann Carlton</h5>
                            <p class="card-text">Antioquia, Colombia</p>
                            <div class="precio">
                                <h5>$275.400</h5>
                                <p>Por noche</p>
                            </div>
                            <a href="./detail.php" class="btn btn-primary w-100">Consultar oferta</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img width="250px" src="../assets/hotel3.png" class="card-img-top" alt="Oferta 3">
                        <div class="card-body">
                            <h5 class="card-title">Bahía príncipe fantasía</h5>
                            <p class="card-text">Punta Cana, Republica Dominicana </p>
                            <div class="precio">
                                <h5>$974.455</h5>
                                <p>Por noche</p>
                            </div>
                            <a href="./detail.php" class="btn btn-primary w-100">Consultar oferta</a>
                        </div>
                    </div>
                </div>
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