<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title') ::NewsAggregator @show</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
<x-header></x-header>
<main>

    <div class="album py-5 bg-light">
        <div class="container">
            @yield('content')
        </div>
    </div>

</main>

<x-footer></x-footer>


<script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
@stack('js')
</body>
</html>
