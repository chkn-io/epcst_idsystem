<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style type="text/css">
        @font-face {
            font-family: Impact;
            src: url('{{ asset("fonts/impact.tff") }}');
        }
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    
    <!-- Template Main CSS File -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-success">
    <form id="scan-form">
        @csrf
        <input type="text" name="snapshot" id="snapshot">
        <input type="text" name="rfid_code" id="scanned-code">
    </form>
    <input type="text" id="rfid-input" >

    <div class="camera" id="camera-handle">
        <button id="start-camera">Start Camera</button>
        <video id="video" width="220" height="140" autoplay></video>
        <button id="click-photo">Click Photo</button>
        <canvas id="canvas" width="320" height="240"></canvas>
    </div>
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="row justify-content-between">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<audio id="success_sound">
    <source src="{{asset('audio/success.wav')}}" type="audio/mpeg">
</audio>

<audio id="beep_sound">
    <source src="{{asset('audio/beep.mp3')}}" type="audio/mpeg">
</audio>

<script type="module" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="module" src="{{asset('js/jquery.min.js')}}"></script>
<script type="module" src="{{asset('js/rfid.js')}}"></script>
<script type="module">
    
     let scanner = new Instascan.Scanner({video: document.getElementById('   ')})
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                alert('No cameras found!')
            }
        }).catch(function(e){
            console.error(e);
        })

        scanner.addListener('scan',function(c){
            $('#rfid-input').val(c);
            // $('#rfid-input').focus().trigger({ type : 'keypress', which : 13 });
            var keyEvent = jQuery.Event("keypress");
                keyEvent.keyCode = 13;
                $("#rfid-input").trigger(keyEvent);
        });
</script>
</body>
</html>
