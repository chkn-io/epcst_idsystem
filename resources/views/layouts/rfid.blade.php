<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    
    <!-- Template Main CSS File -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-success">
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="row justify-content-between">
                        <div class="col-md-8 bg-white p-3 pt-4">
                            <img width="100px" src="{{asset('img/logo.png')}}" class="float-start me-3" alt="">
                            <h2 class="float-start">
                                EASTWOODS Professional College <br>
                                <span class="text-muted" style="font-size:15pt;">of Science and Technology</span>
                            </h2>
                            <br>
                            <hr style="width:80%;float:left;">
                            <br>
                            <p id="on-duty" class="float-start">Guard on Duty: Juan Dela Cruz</p>
                        </div>
                        <div class="col-md-4 bg-dark text-white p-3">
                            <p id="time">4:30 PM</p>
                            <p id="date" class="text-warning">January 19, 2023 | Thursday</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
