<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> Home
    </a>
</li>







@can('access_dirty_area')
    <br>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('receptions.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-box-arrow-down" style="line-height: 1;"></i> INGRESO INSTRUMENTAL
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('create_receptions')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('receptions.*') ? 'c-active' : '' }}"
                        href="{{ route('receptions.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-arrow-down-square" style="line-height: 1;"></i> Registro Ingreso
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('receptions.index') ? 'c-active' : '' }}"
                    href="{{ route('receptions.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-caret-down" style="line-height: 1;"></i> Todos los Ingresos
                </a>
            </li>



        </ul>
    </li>
    @can('access_wash_area')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('receptions.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-tropical-storm" style="line-height: 1;"></i> INGRESO LAVADORA
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs() ? 'c-active' : '' }}" href="#">
                        <i class="c-sidebar-nav-icon bi bi-wind" style="line-height: 1;"></i> Registro ingreso
                    </a>
                </li>
            </ul>
        </li>
    @endcan
@endcan


@can('access_zne_area')
    <br>
    <br>

    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('testbds.*') || request()->routeIs('testbds.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-box-seam" style="line-height: 1;"></i> TEST BD & DICK
        </a>
        <ul class="c-sidebar-nav-dropdown-items">

            @can('create_Testbds')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('testbds.create') ? 'c-active' : '' }}"
                        href="{{ route('testbds.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-bookmark-plus" style="line-height: 1;"></i> Registro de Test BD &
                        Dick.
                    </a>
                </li>
            @endcan

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('testbds.index') ? 'c-active' : '' }}"
                    href="{{ route('testbds.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-card-checklist" style="line-height: 1;"></i> Todos los Test de BD &
                    Dick
                </a>
            </li>
        </ul>

    </li>

    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('labelqrs.*') || request()->routeIs('preparations.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-upc-scan" style="line-height: 1;"></i> PREPARA. / REG. PROCESO
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('preparations.index') ? 'c-active' : '' }}"
                    href="{{ route('preparations.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Stock_Preparación.
                </a>
            </li>
            @can('access_labelqrs')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('labelqrs.create') ? 'c-active' : '' }}"
                        href="{{ route('labelqrs.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-tags" style="line-height: 1;"></i> Registro Ingreso / Etiqueta

                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('labelqrs.index') ? 'c-active' : '' }}"
                    href="{{ route('labelqrs.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los ciclos generados QR.
                </a>
            </li>
        </ul>
    </li>

@endcan

@can('access_ze_area')
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('discharges.*') || request()->routeIs('discharges.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-box-arrow-up-right" style="line-height: 1;"></i> DESCARGA DE INSTRUMENTAL
        </a>
        <ul class="c-sidebar-nav-dropdown-items">

            @can('create_discharges')
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('discharges.index') ? 'c-active' : '' }}"
                    href="{{ route('discharges.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Liberar Ciclos.
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_almacen_area')
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('expedition.*') || request()->routeIs('stocks.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i> ALMACEN
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_stock')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('stocks.*') ? 'c-active' : '' }}"
                        href="{{ route('stocks.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Stock.
                    </a>
                </li>
            @endcan
            @can('access_expedition')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('expeditions.index') ? 'c-active' : '' }}"
                        href="{{ route('expeditions.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-send" style="line-height: 1;"></i> Despachar
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('expeditions.index') ? 'c-active' : '' }}"
                        href="{{ route('expeditions.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-send" style="line-height: 1;"></i> Todos los despachos
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('access_products')
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('products.*') || request()->routeIs('product-categories.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-building" style="line-height: 1;"></i> Base de Datos RUMED
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_product_categories')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('product-categories.*') ? 'c-active' : '' }}"
                        href="{{ route('product-categories.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i> Categoria/Especialidad
                    </a>
                </li>
            @endcan
            @can('create_products')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('products.create') ? 'c-active' : '' }}"
                        href="{{ route('products.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Crear Paquete
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('products.index') ? 'c-active' : '' }}"
                    href="{{ route('products.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los Paquetes
                </a>
            </li>
            @can('print_barcodes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('barcode.print') ? 'c-active' : '' }}"
                        href="{{ route('barcode.print') }}">
                        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Print Barcode
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan



@can('access_informats')


    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('informats.*') || request()->routeIs('institute.*') || request()->routeIs('area.*') || request()->routeIs('units.*') || request()->routeIs('machine.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-journal-bookmark" style="line-height: 1;"></i> Configuración Servicio.
        </a>

        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_Informat_institutes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('institute.*') ? 'c-active' : '' }}"
                        href="{{ route('institute.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-bank" style="line-height: 1;"></i> Hospital
                    </a>
                </li>
            @endcan
            @can('access_informat_machines')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('machine.*') ? 'c-active' : '' }}"
                        href="{{ route('machine.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Equipos
                    </a>
                </li>
            @endcan
            @can('access_informat_areas')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('area.*') ? 'c-active' : '' }}"
                        href="{{ route('area.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Áreas
                    </a>
                </li>
            @endcan
           
            @can('access_informat_units')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('units.*') ? 'c-active' : '' }}"
                        href="{{ route('units.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Presentación
                    </a>
                </li>
            @endcan
                
          

            @can('create_informats')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('informats.create') ? 'c-active' : '' }}"
                        href="{{ route('informats.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Registrar Insumo
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('informats.index') ? 'c-active' : '' }}"
                        href="{{ route('informats.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los Insumos
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
@can('access_user_management')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> Gestión del Usuario.
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('users.create') ? 'c-active' : '' }}"
                    href="{{ route('users.create') }}">
                    <i class="c-sidebar-nav-icon bi bi-person-plus" style="line-height: 1;"></i> Crear Usuario
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('users*') ? 'c-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-person-lines-fill" style="line-height: 1;"></i> Todo los usuarios
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('roles*') ? 'c-active' : '' }}"
                    href="{{ route('roles.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-key" style="line-height: 1;"></i> Roles y Permisos.
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('access_settings')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('settings*') || request()->routeIs('settings*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-gear" style="line-height: 1;"></i> Configuración
        </a>


        @can('access_settings')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'c-active' : '' }}"
                        href="{{ route('settings.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> Configuración del Sistema
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endcan
