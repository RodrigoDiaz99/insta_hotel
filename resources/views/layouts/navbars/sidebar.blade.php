<nav class="sidenav navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner scroll-scrollx_visible">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('front') }}">
                <img src="{{ asset('favicon/logo.png') }}"> Easy Motel
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav ">

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('establishments.index') }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Todos Mis Establecimientos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('establishment-areas.index') }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-bullet-list-67 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Áreas de Establecimintos</span>
                        </a>
                    </li>
                    
                    {{-- Hoteles --}}
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('clientes.index') }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <span class="nav-link-text ms-1">Clientes</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="  ">
                            <div class="icon icon-shape icon-sm border-radius-md text-danger text-center me-2 d-flex align-items-center justify-content-center">
                            </div>
                            <span class="ml-2  ps-4 ms-2 text-uppercase text-xs text-danger font-weight-bolder  ">Mis Hoteles</span>
                        </a>
                    </li>
                    @forelse ($hotels as $establishment)
                        @include('layouts.navbars.sidebar_content')
                    @empty
                        <li class="nav-item mt-3">
                            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-danger">NO HAY HOTELES
                            </h6>
                        </li>
                    @endforelse
                    {{-- Fin Establecimientos --}}

                    {{-- Moteles --}}
                    <li class="nav-item">
                        <a class="  ">
                            <div class="icon icon-shape icon-sm border-radius-md text-danger text-center me-2 d-flex align-items-center justify-content-center">
                            </div>
                            <span class="ml-2  ps-4 ms-2 text-uppercase text-xs text-danger font-weight-bolder  ">Mis moteles</span>
                        </a>
                    </li>
                    @forelse ($motels as $establishment)
                        @include('layouts.navbars.sidebar_content')
                    @empty
                        <li class="nav-item mt-3">
                            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-danger">NO HAY MOTELES
                            </h6>
                        </li>
                    @endforelse
                    {{-- Fin Establecimientos --}}


                </ul>
                {{-- Fin Contenido --}}

            </div>
        </div>
    </div>
</nav>
