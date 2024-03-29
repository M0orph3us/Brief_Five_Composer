<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/style/style.css" />
    <title><?= ucfirst(str_replace('_', ' ', $view)) ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href=<?= URL_HOMEPAGE ?>>HOME</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href=<?= URL_OPENINGDAY ?>>OPENING DAY</a>
                        </li>
                        <?php if (isset($_SESSION['userIsConnected']) && !empty($_SESSION['userIsConnected']) && $_SESSION['userIsConnected'] === true) {
                            echo '<li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                href=' . URL_RESERVATIONPAGE . '>RESERVATION</a>
                                </li>';
                            echo '<li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                href=' . URL_PROFILPAGE . '>PROFIL</a>
                                </li>';
                        }

                        if (isset($_SESSION['adminIsConnected']) && !empty($_SESSION['adminIsConnected']) && $_SESSION['adminIsConnected'] === true) {
                            echo "<li class='nav-item'>
                            <a class='nav-link' href=" . URL_ADMINPAGE . " >ADMIN</a>
                            </li>";
                        }
                        if (isset($_SESSION['userIsConnected']) && !empty($_SESSION['userIsConnected']) && $_SESSION['userIsConnected'] === true || isset($_SESSION['adminIsConnected']) && !empty($_SESSION['adminIsConnected']) && $_SESSION['adminIsConnected'] === true || isset($_SESSION['superAdminIsConnected']) && !empty($_SESSION['superAdminIsConnected']) && $_SESSION['superAdminIsConnected'] === true) {
                            echo '<li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                href=' . URL_LOGOUT . '>LOGOUT</a>
                                </li>';
                        } else {
                            echo "<li class='nav-item'>
                            <a class='nav-link' href=" . URL_REGISTER . " >REGISTER</a>
                            </li>";
                            echo "<li class='nav-item'>
                            <a class='nav-link' href=" . URL_LOGIN . " >LOGIN</a>
                            </li>";
                        } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>