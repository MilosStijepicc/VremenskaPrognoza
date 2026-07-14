<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administracija</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <a class="navbar-brand ms-3" href="#">
            <i class="fa-solid fa-cloud"></i>
            Weather Admin
        </a>


        <div class="me-3 text-white">

            <i class="fa-solid fa-user-shield"></i>
            Administrator

        </div>

    </div>

</nav>

<div class="d-flex">

    <div class="bg-dark text-white p-3"
         style="width: 250px; min-height: 100vh;">


        <h5 class="mb-4">
            <i class="fa-solid fa-bars"></i>
            Meni
        </h5>

        <ul class="nav flex-column">


            <li class="nav-item mb-2">

                <a href="{{ route('dashboard') }}"
                   class="nav-link text-white">

                    <i class="fa-solid fa-house"></i>
                    Dashboard

                </a>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('weather-create') }}"
                   class="nav-link text-white">

                    <i class="fa-solid fa-temperature-half"></i>
                    Dodaj Weather

                </a>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('weather-change') }}"
                   class="nav-link text-white">

                    <i class="fa-solid fa-pen-to-square"></i>
                    Promijeni Weather

                </a>

            </li>

            <li class="nav-item mb-2">

                <a href="{{ route('admin-forecasts') }}"
                   class="nav-link text-white">

                    <i class="fa-solid fa-calendar-days"></i>
                    Prognoze

                </a>

            </li>

        </ul>

    </div>

    <div class="flex-grow-1 p-4">
        @yield("content")
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
