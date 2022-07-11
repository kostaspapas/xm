<!DOCTYPE html>
<html>
    <head>
        <title>xm-laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/libs/jquery-ui.min.css">
        <script src="/assets/libs/jquery.js"></script>
        <script src="/assets/libs/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Search form</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
