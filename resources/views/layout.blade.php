<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/dashboard">🌦 Weather App</a>

        <div class="navbar-nav ms-auto d-flex flex-row align-items-center">

            <a class="nav-link text-white me-3" href="/dashboard">Dashboard</a>
            <a class="nav-link text-white me-3" href="/admin/change-weather">Change</a>
            <a class="nav-link text-white me-3" href="/admin/add-weather">Add</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>

        </div>

    </div>
</nav>

<div class="container mt-4">

    @yield('content')

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
