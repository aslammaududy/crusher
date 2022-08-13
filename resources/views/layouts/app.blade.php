<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BOM</title>
    <link rel="stylesheet" href='{{ asset("assets/bootstrap/css/bootstrap.min.css") }}'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href='{{ asset("assets/fonts/fontawesome-all.min.css") }}'>
    <link rel="stylesheet" href='{{ asset("assets/fonts/font-awesome.min.css") }}'>
    <link rel="stylesheet" href='{{ asset("assets/fonts/fontawesome5-overrides.min.css") }}'>
    @livewireStyles
</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">
        <nav
            class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 toggled">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-text mx-3"><span>ES <br> Inventory</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="{{ url('scanner') }}"><i
                                class="fas fa-qrcode"></i><span>Scanner</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('account') }}"><i
                                class="fas fa-user"></i><span>Account</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop"
                            type="button"><i class="fas fa-bars"></i>
                        </button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow">
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    @auth
                                    <a class="dropdown-toggle nav-link" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" href="javascript:;"><span
                                            class="d-lg-inline me-2 text-gray-600 small">Logout</span>
                                    </a>

                                    <form class="d-none" action="{{ route('logout') }}" id="logout-form" method="post">
                                        @csrf
                                    </form>
                                    @else
                                    <a class="dropdown-toggle nav-link" href="{{ route('login') }}"><span
                                            class="d-lg-inline me-2 text-gray-600 small">Login</span>
                                    </a>
                                    @endauth
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <script src='{{ asset("assets/bootstrap/js/bootstrap.min.js") }}'></script>
    <script src='{{ asset("assets/js/chart.min.js") }}'></script>
    <script src='{{ asset("assets/js/script.min.js") }}'></script>
    <script src='{{ asset("assets/js/jquery.min.js") }}'></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    @livewireScripts

    @stack('scripts')
</body>

</html>
