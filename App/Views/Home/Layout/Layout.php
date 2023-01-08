<?php

use App\Model\Session; ?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Your personnal CSS file -->
    <link rel="stylesheet" href="/public/assets/css/styles.css">

    <title>My PHP Native MVC template</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="mb-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">Main Site</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                A dropdown menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">First link</a></li>
                                <li><a class="dropdown-item" href="#">Another link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <?php if (!empty($_SESSION) && $_SESSION['logged'] === true) : ?>
                        <?php if (Session::isAdmin($_SESSION['sessionKey'])) : ?>
                            <a class="" href="/dashboard"><button type="button" class="btn btn-outline-primary">Admin Dashboard</button></a>
                        <?php endif; ?>
                        <a class="" href="/logout"><button type="button" class="btn btn-primary">Log Out</button></a>
                    <?php else : ?>
                        <a href="/login"><button type="button" class="btn btn-outline-primary">Login</button></a>
                        <a href="/register"><button type="button" class="btn btn-primary">Sign-up</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php include htmlspecialchars($view); ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container p-4 pb-0">
            <section class="">
                <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">Register for free</span>
                    <a href="/register"><button type="button" class="btn btn-outline-primary">Sign-up</button></a>
                </p>
            </section>
        </div>

        <div class="text-center p-3">
            © 2023 Copyright:
            <a class="link" href="/">PHP Native MVC</a>
        </div>
    </footer>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Your personnal JS file -->
    <script src="/public/assets/js/main.js"></script>
</body>

</html>