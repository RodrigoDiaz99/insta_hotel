<div class="nav-item ">
    <a class="nav-link " data-toggle="collapse" href="#collapse_{{ $establishment->id }}" role="button">
        <h6 class="ps-4 ms-2 text-uppercase text-xs  font-weight-bolder opacity-6">
            {{ $establishment->name }}
        </h6>
    </a>
</div>

<div class="collapse multi-collapse" id="collapse_{{ $establishment->id }}">

    {{-- Toggler de collapse habitaciones --}}
    <div class="nav-item ">
        <a class="nav-link " data-toggle="collapse" href="#habitaciones_collapse_{{ $establishment->id }}" role="button">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-house"></i>
            </div>
            <span class="nav-link-text ms-1">Habitaciones y reservaciones</span>
        </a>
    </div>
    {{-- Toggler de collapse habitaciones --}}

    {{-- Contenido del collapse Habitaciones --}}
    <div id="habitaciones_collapse_{{ $establishment->id }}" class="nav-item pl-3 collapse ">
        <div class="nav-item ">
            <a class="nav-link " href="{{ route('establishments.room-areas.index', $establishment->id) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-house"></i>
                </div>
                <span class="nav-link-text ms-1">Áreas de Habitaciones</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="nav-link " href="{{ route('tiposhabitacion.index', $establishment->id) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-house"></i>
                </div>
                <span class="nav-link-text ms-1">Tipos de habitación</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="nav-link " href="{{ route('rooms.index', $establishment->id) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-house"></i>
                </div>
                <span class="nav-link-text ms-1">Habitaciones</span>
            </a>
        </div>
        <div class="nav-item ">
            <a class="nav-link " href="{{ route('reservaciones.index', $establishment->id) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-house"></i>
                </div>
                <span class="nav-link-text ms-1">Reservaciones</span>
            </a>
        </div>
    </div>
    {{-- Contenido del collapse habitaciones --}}

     {{-- Toggler de collapse habitaciones --}}
     <div class="nav-item ">
        <a class="nav-link " data-toggle="collapse" href="#productos_collapse_{{ $establishment->id }}" role="button">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-house"></i>
            </div>
            <span class="nav-link-text ms-1">Productos</span>
        </a>
    </div>
    {{-- Toggler de collapse habitaciones --}}

    {{-- Contenido del collapse Habitaciones --}}
    <div id="productos_collapse_{{ $establishment->id }}" class="nav-item pl-3 collapse ">
        <div class="nav-item">
            <a class="nav-link " href="{{ route('product.index', ['establishment_id' => $establishment->id]) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-bell-concierge"></i>
                </div>
                <span class="nav-link-text ms-1">Productos</span>
            </a>
        </div>
    
        <div class="nav-item">
            <a class="nav-link " href="{{ route('tipo.index', ['establishment_id' => $establishment->id]) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-bell-concierge"></i>
                </div>
                <span class="nav-link-text ms-1">Familia de productos</span>
            </a>
        </div>
    
        <div class="nav-item">
            <a class="nav-link " href="{{ route('proveedores.index', ['establishment_id' => $establishment->id]) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-bell-concierge"></i>
                </div>
                <span class="nav-link-text ms-1">Proveedores</span>
            </a>
        </div>
        <div class="nav-item">
            <a class="nav-link " href="{{ route('ingredient.index', ['establishment_id' => $establishment->id]) }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-bell-concierge"></i>
                </div>
                <span class="nav-link-text ms-1">Ingredientes</span>
            </a>
        </div>
    </div>
    {{-- Contenido del collapse habitaciones --}}


    <div class="nav-item">
        <a class="nav-link " href="{{ route('departamento.index', $establishment->id) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-cart text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Departamentos</span>
        </a>
    </div>
    <div class="nav-item">
        <a class="nav-link " href="{{ route('compras.index', ['establishment_id' => $establishment->id]) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Compras</span>
        </a>
    </div>
    <div class="nav-item">
        <a class="nav-link " href="{{ route('ventas.index',['establishment_id' => $establishment->id])}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Ventas</span>
        </a>
    </div>

    <div class="nav-item">
        <a class="nav-link " href="{{ route('almacen.index', ['establishment_id' => $establishment->id]) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Almacen</span>
        </a>
    </div>
    {{-- {{ route('almacen.index', ['establishment_id' => $establishment->id]) }} --}}
    <div class="nav-item">
        <a class="nav-link " href="{{ route('tramo.index', ['establishment_id' => $establishment->id]) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Tramos</span>
        </a>
    </div>
    <div class="nav-item">
        <a class="nav-link " href="{{ route('tarifa.index', ['establishment_id' => $establishment->id]) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Tarifas</span>
        </a>
    </div>
    <div class="nav-item">
        <a class="nav-link " href="{{ route('comanda.index', ['establishment_id' => $establishment->id]) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Comandas</span>
        </a>
    </div>
    <div class="nav-item">
        <a class="nav-link " href="{{ route('pedido.index', ['establishment_id' => $establishment->id]) }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <span class="nav-link-text ms-1">Pedidos</span>
        </a>
    </div>
</div>
