<!--NAVBAR-->
<nav class="navbar navbar-expand-lg texto-nav fondo-nav" aria-label="Offcanvas navbar large">
    <div class="container-fluid px-4 py-1" id="header">

        <!--Logo-->
        <a class="navbar-brand p-0 ms-3" href="/">
            <img src="/imagenes/logo-nav.png" alt="logo del Jardín Etnobotánico" style="width:90px;">
        </a>

        <!--botón hamburguesa-->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--Menú superior   -->
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <a class="offcanvas-logo" href="index.html" id="offcanvasNavbar2Label">
                    <img src="/imagenes/logo-nav.png" alt="logo del Jardín Etnobotánico">
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1">
                    @if(Auth::user())
                    <!-- ----- Inicio ----- -->
                    <li class="nav-item">
                        <a class="nav-link @if(request()->path() == '/home') active @endif" href="/home">
                           Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->path() == '/grupos' OR request()->path() == '/boletos' ) active @endif" href="/grupos">
                           Boletos
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="nolink btn" style="padding:0;margin:0;">
                                    Salir
                            </button>
                        </form>

                    </li>

                    {{-- @else
                        <li class="nav-item">
                            <a class="nav-link @if(request()->path() == '/') active @endif" href="/">
                            Ingresar
                            </a>
                        </li> --}}
                    @endif



                </ul>


            </div>
        </div>
    </div>
</nav>

