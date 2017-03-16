<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ config('blog.meta.keywords') }}">
    <meta name="description" content="{{ config('blog.meta.description') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ config('blog.default_icon') }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @yield('styles')
</head>
<body>
    <div id="app">
        @include('particals.navbar')

        <div class="main">
            @yield('content')
        </div>

        @include('particals.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ elixir('/js/app.js') }}"></script>

    @yield('scripts')

    <script>
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
        });
    </script>
</body>
</html>
