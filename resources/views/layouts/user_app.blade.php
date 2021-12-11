<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bool b&b | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="d-flex wrapper-user">

        <header>
            @include('partials.header', ["header_link" => config('header_navbar')])
        </header>
    
        <main class="main-user">
            @yield('content')
        </main>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>