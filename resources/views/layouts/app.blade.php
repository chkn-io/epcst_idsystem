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
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/print.css')}}" media="print" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">


</head>
<body>
    <div id="app">
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
            <a href="{{url('/')}}" style="text-decoration:none" class="logo d-flex align-items-center">
                <img src="{{asset('img/logo.png')}}" alt="">
                <span class="d-none d-lg-block">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <i class="fas fa-bars toggle-sidebar-btn"></i>
            </div><!-- End Logo -->
            <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{auth()->user()->name}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{auth()->user()->name}}</h6>
                        <span>{{auth()->user()->role}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{url('changePassword')}}">
                        <i class="fas fa-gear"></i>
                        <span>Change Password</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-arrow-right"></i>
                        <span>{{ __('Logout') }}</span>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link  {{ $active == 'home' ? '': 'collapsed' }}" href="{{ url('/home') }}">
                <i class="fas fa-th"></i>
                <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link   {{ $active == 'employees' ? '': 'collapsed' }}" href="{{ url('/employees') }}">
                    <i class="fas fa-users"></i>
                    <span>Employees</span>
                    </a>
                </li><!-- End Dashboard Nav -->
                <li class="nav-item">
                    <a class="nav-link   {{ $active == 'users' ? '': 'collapsed' }}" href="{{ url('/users') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Users</span>
                    </a>
                </li><!-- End Dashboard Nav -->
                <li class="nav-item">
                    <a class="nav-link   {{ $active == 'dtr' ? '': 'collapsed' }}" href="{{ url('/dtr') }}">
                    <i class="fas fa-clock"></i>
                    <span>Daily Time Records</span>
                    </a>
                </li><!-- End Dashboard Nav -->
                
                <li class="nav-item">
                    <a class="nav-link   {{ $active == 'reports' ? '': 'collapsed' }}"  href="{{ url('/reports') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Reports</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link   {{ $active == 'reports-sa' ? '': 'collapsed' }}"  href="{{ url('/reports-sa') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>SA Attendance</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            @endif
            

            <li class="nav-item">
                <a class="nav-link   {{ $active == 'rfid' ? '': 'collapsed' }}" href="{{ url('/rfid') }}">
                <i class="fa-solid fa-id-badge"></i>
                <span>RFID Scanner</span>
                </a>
            </li><!-- End Dashboard Nav -->
            </ul>

        </aside><!-- End Sidebar-->

        <main id="main" class="main">
            @yield('content')
        </main>
    </div>

    
    <script type="module" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="module" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script type="module" src="{{asset('js/select2.min.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
  @if($active === "employees")
    <script type="module" src="{{asset('js/employee.js')}}"></script>
  @elseif($active === "home")
    <script type="module" src="{{asset('js/home.js')}}"></script>
  @elseif($active === "reports")
    <script type="module" src="{{asset('js/reports.js')}}"></script>
    @elseif($active === "reports-sa")
    <script type="module" src="{{asset('js/reports.js')}}"></script>
    @elseif($active === "dtr")
    <script type="module" src="{{asset('js/dtr.js')}}"></script>
  @endif
</body>
</html>
