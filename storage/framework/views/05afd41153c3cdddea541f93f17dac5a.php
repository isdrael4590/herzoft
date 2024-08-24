<li class="c-sidebar-nav-item <?php echo e(request()->routeIs('home') ? 'c-active' : ''); ?>">
    <a class="c-sidebar-nav-link" href="<?php echo e(route('home')); ?>">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> Home
    </a>
</li>







<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_dirty_area')): ?>
    <br>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('receptions.*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-box-arrow-down" style="line-height: 1;"></i> INGRESO INSTRUMENTAL
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_receptions')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('receptions.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('receptions.create')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-arrow-down-square" style="line-height: 1;"></i> Registro Ingreso
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('receptions.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('receptions.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-caret-down" style="line-height: 1;"></i> Todos los Ingresos
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </li>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_wash_area')): ?>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('receptions.*') ? 'c-show' : ''); ?>">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-tropical-storm" style="line-height: 1;"></i> INGRESO LAVADORA
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs() ? 'c-active' : ''); ?>" href="#">
                        <i class="c-sidebar-nav-icon bi bi-wind" style="line-height: 1;"></i> Registro ingreso
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_zne_area')): ?>
    <br>
    <br>

    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('testbds.*') || request()->routeIs('testbds.*') ? 'c-show' : ''); ?>">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_testbds')): ?>
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-box-seam" style="line-height: 1;"></i> TESTS DE EQUIPOS
            </a>
            <ul class="c-sidebar-nav-dropdown-items">


                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('testvacuums.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('testvacuums.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-bookmark-plus" style="line-height: 1;"></i> Test de Vacio.
                    </a>
                </li>


                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('testbds.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('testbds.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-card-checklist" style="line-height: 1;"></i>Test de Bowie &
                        Dick
                    </a>
                </li>

            </ul>
        <?php endif; ?>
    </li>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_preparations')): ?>
    <br>
    <br>
        <li
            class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('RecepReprocess.*') || request()->routeIs('preparations.*') ? 'c-show' : ''); ?>">

            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-exclamation-square" style="line-height: 1;"></i> PREPARACIÓN
            </a>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('RecepReprocess.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('RecepReprocess.create')); ?>">
                        <i class="c-sidebar-nav-icon bi-bootstrap-reboot" style="line-height: 1;"></i> Reprocesar Instrumental.
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('preparations.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('preparationDetails.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-list-stars" style="line-height: 1;"></i> Stock Preparación.
                    </a>
                </li>

            </ul>
        </li>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_labelqrs')): ?>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('labelqrs.*') ? 'c-show' : ''); ?>">

            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-upc-scan" style="line-height: 1;"></i> PRODUCCIÓN
            </a>

            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('labelqrs.create') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('labelqrs.create')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-tags" style="line-height: 1;"></i> Registro Ingreso / Etiqueta

                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('labelqrs.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('labelqrs.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los ciclos generados.
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('labelqrDetails.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('labelqrDetails.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-list-check" style="line-height: 1;"></i> Instrumental Procesado.
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_esteril_area')): ?>
    <br>
    <br>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_discharges')): ?>
        <li
            class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('discharges.*') || request()->routeIs('discharges.*') ? 'c-show' : ''); ?>">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon bi bi-box-arrow-up-right" style="line-height: 1;"></i> DESCARGA PROCESOS
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_discharges')): ?>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('discharges.index') ? 'c-active' : ''); ?>"
                            href="<?php echo e(route('discharges.index')); ?>">
                            <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Liberar Ciclos.
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_almacen_area')): ?>
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('expedition.*') || request()->routeIs('stocks.*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i> ALMACEN
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_stocks')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('stocks.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('stockDetails.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Stock.
                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_expeditions')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('expeditions.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('expeditions.create')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-send" style="line-height: 1;"></i> Despachar
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('expeditions.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('expeditions.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-send" style="line-height: 1;"></i> Todos los despachos
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_reports')): ?>
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('reports.*') || request()->routeIs('reports.*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i> REPORTES
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('reports.*') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('testbd-report.index')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Reporte Test Bowie &
                    Dick.
                </a>
            </li>
        </ul>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('reports.*') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('reception-report.index')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Reporte Recepción.
                </a>
            </li>
        </ul>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('reports.*') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('discharge-report.index')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Reporte Descarga.
                </a>
            </li>
        </ul>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('reports.*') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('expedition-report.index')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Reporte Despachos.
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_products')): ?>
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('products.*') || request()->routeIs('product-categories.*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-building" style="line-height: 1;"></i> Base de Datos RUMED
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_product_categories')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('product-categories.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('product-categories.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i> Categoria/Especialidad
                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_products')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('products.create') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('products.create')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Crear Paquete
                    </a>
                </li>
            <?php endif; ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('products.index') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('products.index')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los Paquetes
                </a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_importproducts')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('import-products.create') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('import-products.create')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-arrow-down-square" style="line-height: 1;"></i> Importar Paquetes
                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_barcodes')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('barcode.print') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('barcode.print')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Print Barcode
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </li>
<?php endif; ?>



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_informats')): ?>


    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('informats.*') || request()->routeIs('institute.*') || request()->routeIs('area.*') || request()->routeIs('units.*') || request()->routeIs('machine.*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-wrench" style="line-height: 1;"></i> Configuración Servicio.
        </a>

        <ul class="c-sidebar-nav-dropdown-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_Informat_institutes')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('institute.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('institute.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-bank" style="line-height: 1;"></i> Hospital
                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_informat_machines')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('machine.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('machine.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Equipos
                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_informat_lotes')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('lote.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('lote.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-bookmark-check" style="line-height: 1;"></i> Lote Procesados
                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_informat_areas')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('area.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('area.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Áreas
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_informat_units')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('units.*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('units.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Presentación
                    </a>
                </li>
            <?php endif; ?>



            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_informats')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('informats.create') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('informats.create')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Registrar Insumo
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('informats.index') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('informats.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los Insumos
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_user_management')): ?>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('roles*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> Gestión del Usuario.
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('users.create') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('users.create')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-person-plus" style="line-height: 1;"></i> Crear Usuario
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('users*') ? 'c-active' : ''); ?>"
                    href="<?php echo e(route('users.index')); ?>">
                    <i class="c-sidebar-nav-icon bi bi-person-lines-fill" style="line-height: 1;"></i> Todo los usuarios
                </a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_roles')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('roles*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('roles.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-key" style="line-height: 1;"></i> Roles y Permisos.
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_settings')): ?>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e(request()->routeIs('settings*') || request()->routeIs('settings*') ? 'c-show' : ''); ?>">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-gear" style="line-height: 1;"></i> Configuración
        </a>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_settings')): ?>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->routeIs('settings*') ? 'c-active' : ''); ?>"
                        href="<?php echo e(route('settings.index')); ?>">
                        <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> Configuración del Sistema
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </li>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/layouts/menu.blade.php ENDPATH**/ ?>