<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-body-secondary">


    <x-header />

    @if (session('message'))
        <div class="alert alert-info">
            <h1>{{ session('message') }}</h1>
        </div>
    @endif

    @yield('content')

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2025 Event Manager. All Rights Reserved.</p>
    </footer>



</body>

</html>
