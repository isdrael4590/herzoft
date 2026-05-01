{{-- ============================================================
     MENU LATERAL - HERZOFT
     ============================================================ --}}

{{-- ── HOME ─────────────────────────────────────────────────── --}}
<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-house-door-fill"></i> Inicio
    </a>
</li>

{{-- ── ZONA SUCIA ───────────────────────────────────────────── --}}
@can('access_dirty_area')
    <li class="c-sidebar-nav-title nav-title--dirty">Zona Sucia</li>

    @can('access_receptions')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('receptions.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-inbox-fill"></i> Ingreso Instrumental
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('create_receptions')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->routeIs('receptions.create') ? 'c-active' : '' }}"
                            href="{{ route('receptions.create') }}">
                            <i class="c-sidebar-nav-icon bi bi-plus-circle-fill"></i> Registrar Ingreso
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('receptions.index') ? 'c-active' : '' }}"
                        href="{{ route('receptions.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-list-ul"></i> Todos los Ingresos
                    </a>
                </li>
            </ul>
        </li>
    @endcan

@endcan

{{-- ── ZONA NO ESTÉRIL ──────────────────────────────────────── --}}
@can('access_zne_area')
    <li class="c-sidebar-nav-title nav-title--zne">Zona No Estéril</li>

    @can('access_wash_area')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('prelavado.*', 'lavados.*', 'descarga-lavado.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-droplet-half"></i> Lavado
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('prelavado.index') ? 'c-active' : '' }}"
                        href="{{ route('prelavado.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-wind"></i> Instrumental a Lavar
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('lavados.*') ? 'c-active' : '' }}"
                        href="{{ route('lavados.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-check2-all"></i> Todos los Lavados
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('descarga-lavado.*') ? 'c-active' : '' }}"
                        href="{{ route('descarga-lavado.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-droplet-fill"></i> Descarga Lavado
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('access_testbds')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('testvacuums.*', 'testbds.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-activity"></i> Tests de Equipos
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('access_testvacuums')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->routeIs('testvacuums.index') ? 'c-active' : '' }}"
                            href="{{ route('testvacuums.index') }}">
                            <i class="c-sidebar-nav-icon bi bi-speedometer2"></i> Test de Vacío
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('testbds.index') ? 'c-active' : '' }}"
                        href="{{ route('testbds.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-patch-check-fill"></i> Test Bowie &amp; Dick
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('access_preparations')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('RecepReprocess.*', 'preparations.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-clipboard2-pulse-fill"></i> Preparación
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('preparations.index') ? 'c-active' : '' }}"
                        href="{{ route('preparationDetails.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-grid-3x3-gap-fill"></i> Stock Preparación
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('access_labelqrs')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('labelqrs.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-qr-code-scan"></i> Producción
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('create_labelqrs')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->routeIs('labelqrs.create') ? 'c-active' : '' }}"
                            href="{{ route('labelqrs.create') }}">
                            <i class="c-sidebar-nav-icon bi bi-tag-fill"></i> Registro / Etiqueta
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('labelqrs.index') ? 'c-active' : '' }}"
                        href="{{ route('labelqrs.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-collection-fill"></i> Todos los Ciclos
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('labelqrDetails.index') ? 'c-active' : '' }}"
                        href="{{ route('labelqrDetails.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-check2-all"></i> Instrumental Procesado
                    </a>
                </li>
            </ul>
        </li>
    @endcan
@endcan

{{-- ── ZONA ESTÉRIL ─────────────────────────────────────────── --}}
@can('access_esteril_area')
    <li class="c-sidebar-nav-title nav-title--esteril">Zona Estéril</li>

    @can('access_discharges')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('discharges.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-box-arrow-up"></i> Descarga Procesos
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('discharges.index') ? 'c-active' : '' }}"
                        href="{{ route('discharges.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-unlock-fill"></i> Liberar Ciclos
                    </a>
                </li>
            </ul>
        </li>
    @endcan
@endcan

{{-- ── ALMACÉN ──────────────────────────────────────────────── --}}
@can('access_almacen_area')
    <li class="c-sidebar-nav-title nav-title--almacen">Almacén</li>

    @can('access_stocks')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('expedition.*', 'stocks.*') ? 'c-show' : '' }}">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-archive-fill"></i> Almacén
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('stocks.*') ? 'c-active' : '' }}"
                        href="{{ route('stockDetails.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-boxes"></i> Stock
                    </a>
                </li>
                @can('access_expeditions')
                    @can('create_expeditions')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link {{ request()->routeIs('expeditions.create') ? 'c-active' : '' }}"
                                href="{{ route('expeditions.create') }}">
                                <i class="c-sidebar-nav-icon bi bi-send-fill"></i> Despachar
                            </a>
                        </li>
                    @endcan
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->routeIs('expeditions.index') ? 'c-active' : '' }}"
                            href="{{ route('expeditions.index') }}">
                            <i class="c-sidebar-nav-icon bi bi-truck"></i> Todos los Despachos
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
@endcan

{{-- ── REPORTES ─────────────────────────────────────────────── --}}
@can('access_reports')
    <li class="c-sidebar-nav-title nav-title--reports">Reportes</li>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('reports.*', 'products-report.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-graph-up-arrow"></i> Reportes
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('reports.testbd-report.*') ? 'c-active' : '' }}"
                    href="{{ route('testbd-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-file-earmark-bar-graph-fill"></i> Test Bowie &amp; Dick
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('reports.reception-report.*') ? 'c-active' : '' }}"
                    href="{{ route('reception-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-file-earmark-medical-fill"></i> Recepción
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('reports.discharge-report.*') ? 'c-active' : '' }}"
                    href="{{ route('discharge-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-file-earmark-arrow-up-fill"></i> Descarga
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('reports.expedition-report.*') ? 'c-active' : '' }}"
                    href="{{ route('expedition-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-file-earmark-check-fill"></i> Despachos
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('products-report.*') ? 'c-active' : '' }}"
                    href="{{ route('products-zona-report.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-file-earmark-spreadsheet-fill"></i> Productos
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('reports.product-history.*') ? 'c-active' : '' }}"
                    href="{{ route('reports.product-history.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-clock-history"></i> Historial por Producto
                </a>
            </li>
        </ul>
    </li>
@endcan

{{-- ── BASE DE DATOS ────────────────────────────────────────── --}}
@can('access_products')
    <li class="c-sidebar-nav-title nav-title--db">Base de Datos</li>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('products.*', 'product-categories.*', 'instrumental.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-database-fill"></i> Base de Datos RUMED
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_product_categories')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('product-categories.*') ? 'c-active' : '' }}"
                        href="{{ route('product-categories.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-grid-fill"></i> Categoría / Especialidad
                    </a>
                </li>
            @endcan
            @can('create_products')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('products.create') ? 'c-active' : '' }}"
                        href="{{ route('products.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-plus-square-fill"></i> Crear Paquete
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('instrumental.index') ? 'c-active' : '' }}"
                        href="{{ route('instrumental.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-scissors"></i> Instrumental
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('products.index') ? 'c-active' : '' }}"
                    href="{{ route('products.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-layers-fill"></i> Todos los Paquetes
                </a>
            </li>
            @can('create_importproducts')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('import-products.create') ? 'c-active' : '' }}"
                        href="{{ route('import-products.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-cloud-download-fill"></i> Importar Paquetes
                    </a>
                </li>
            @endcan
            @can('print_barcodes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('barcode.print') ? 'c-active' : '' }}"
                        href="{{ route('barcode.print') }}">
                        <i class="c-sidebar-nav-icon bi bi-printer-fill"></i> Print Barcode
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

{{-- ── CONFIGURACIÓN SERVICIO ───────────────────────────────── --}}
@can('access_informats')
    <li class="c-sidebar-nav-title nav-title--config">Configuración</li>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('informats.*', 'institute.*', 'area.*', 'units.*', 'machine.*', 'proceso.*', 'lote.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-sliders2-vertical"></i> Configuración Servicio
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_Informat_institutes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('institute.*') ? 'c-active' : '' }}"
                        href="{{ route('institute.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-hospital-fill"></i> Hospital
                    </a>
                </li>
            @endcan
            @can('access_informat_machines')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('machine.*') ? 'c-active' : '' }}"
                        href="{{ route('machine.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-cpu-fill"></i> Equipos
                    </a>
                </li>
            @endcan
            @can('access_informat_proceso')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('proceso.*') ? 'c-active' : '' }}"
                        href="{{ route('proceso.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-diagram-3-fill"></i> Tipo Procesos
                    </a>
                </li>
            @endcan
            @can('access_informat_lotes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('lote.*') ? 'c-active' : '' }}"
                        href="{{ route('lote.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-box-seam-fill"></i> Lotes Procesados
                    </a>
                </li>
            @endcan
            @can('access_informat_areas')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('area.*') ? 'c-active' : '' }}"
                        href="{{ route('area.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-map-fill"></i> Áreas
                    </a>
                </li>
            @endcan
            @can('access_informat_units')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('units.*') ? 'c-active' : '' }}"
                        href="{{ route('units.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-stack"></i> Presentación Insumo
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('informats.index') ? 'c-active' : '' }}"
                    href="{{ route('informats.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-shield-fill-check"></i> Insumos Esterilización
                </a>
            </li>
        </ul>
    </li>
@endcan

{{-- ── GESTIÓN DE USUARIOS ──────────────────────────────────── --}}
@can('access_user_management')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('users*', 'roles*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-people-fill"></i> Gestión de Usuarios
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('create_user_management')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('users.create') ? 'c-active' : '' }}"
                        href="{{ route('users.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-person-plus-fill"></i> Crear Usuario
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('users*') ? 'c-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-person-lines-fill"></i> Todos los Usuarios
                </a>
            </li>
            @can('access_roles')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('roles*') ? 'c-active' : '' }}"
                        href="{{ route('roles.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-shield-lock-fill"></i> Roles y Permisos
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

{{-- ── SISTEMA ──────────────────────────────────────────────── --}}
@can('access_settings')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('settings*', 'backups*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-gear-wide-connected"></i> Sistema
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('settings.index') ? 'c-active' : '' }}"
                    href="{{ route('settings.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-toggles"></i> Configuración del Sistema
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('settings.licence.*') ? 'c-active' : '' }}"
                    href="{{ route('settings.licence.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-patch-check-fill"></i> Licencia del Sistema
                </a>
            </li>
            @if (Route::has('backups.index'))
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('backups*') ? 'c-active' : '' }}"
                        href="{{ route('backups.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-database-fill-check"></i> Backups del Sistema
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endcan
