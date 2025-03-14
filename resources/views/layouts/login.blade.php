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
<body>
<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" style="text-decoration:none" class="logo d-flex align-items-center w-auto">
                  <img src="{{asset('img/logo.png')}}" alt="">
                  <span class="d-none d-lg-block">{{ config('app.name', 'Laravel') }}</span>
                </a>
              </div><!-- End Logo -->

              <div class="card col-md-9 mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small sub-t">Enter your Username & Password to login</p>

                    <div class="text-center">
                      <button class="btn btn-success btn-lg scan-rfid" data-record="@error('email')0 @enderror"> 
                        <i class="fas fa-id-card"></i>
                      </button>
                    </div>
                  </div>
                    @yield('content')
                    

                    <!-- <p class="text-center"><a href="{{route('shutdown_pc')}}" class="btn btn-danger mt-5">Shutdown Computer</a></p> -->
                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
   

  <script type="module" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="module">
    var obj = $('.scan-rfid')
    var obj_rec = obj.attr('data-record')
   
    if(obj_rec.trim() == 1 || obj_rec.trim() == ""){
      loadScanner()
    }else{
      loadAuthentication()
    }
    $('.scan-rfid').click(function(){
      if($(this).attr('data-record') == 0 && $(this).attr('data-record') != ""){
       
        loadScanner()
      }else{
        loadAuthentication()
      }
    }) 

    $(document).click(function(){
      if(obj.attr('data-record') == 1){
        $('#rfid').focus()
      }
    })
    function loadScanner(){
      obj.attr('data-record','1')
      obj.removeClass('btn-danger')
      obj.addClass('btn-success')
      $("#login-form").attr('hidden','hidden')
      $('#scanning-anim').removeAttr('hidden')
      $('.sub-t').html('Scan your card to Sign In.')
      $('#rfid').focus()
    }

    function loadAuthentication(){
      obj.attr('data-record','0')
      obj.removeClass('btn-success')
      obj.addClass('btn-danger')
      $('#login-form').removeAttr('hidden')
      $('#scanning-anim').attr('hidden','hidden')
      $('.sub-t').html('Enter your Username & Password to login')
    }
  </script>
</body>
</html>
