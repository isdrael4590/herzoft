@extends('layouts.app')

@section('title', 'Gestión de Backups')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Gestión de Backups</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-database me-2"></i>
                            Gestión de Backups de Base de Datos
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Estadísticas -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>{{ $backups->count() }}</h4>
                                                <p class="mb-0">Total Backups</p>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-archive fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>{{ $backups->sum('size') > 0 ? number_format($backups->sum('size') / 1024 / 1024, 2) : 0 }}
                                                    MB</h4>
                                                <p class="mb-0">Espacio Total</p>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-hdd fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>{{ config('database.connections.mysql.database') }}</h4>
                                                <p class="mb-0">Base de Datos</p>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-server fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4>{{ $backups->count() > 0 ? $backups->first()['date_human'] : 'N/A' }}
                                                </h4>
                                                <p class="mb-0">Último Backup</p>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-clock fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alertas dinámicas -->
                        <div id="alertContainer"></div>

                        <!-- Botones de acción -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary" id="createBackup">
                                        <i class="fas fa-plus"></i> Crear Backup
                                    </button>
                                    <button type="button" class="btn btn-success" id="uploadBackupBtn">
                                        <i class="fas fa-upload"></i> Subir Backup
                                    </button>
                                    <button type="button" class="btn btn-info" id="refreshBackups">
                                        <i class="fas fa-sync"></i> Actualizar Lista
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de backups -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-file"></i> Nombre del Archivo</th>
                                        <th><i class="fas fa-weight"></i> Tamaño</th>
                                        <th><i class="fas fa-calendar"></i> Fecha de Creación</th>
                                        <th><i class="fas fa-cogs"></i> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="backupsTable">
                                    @forelse($backups as $backup)
                                        <tr>
                                            <td>
                                                <i class="fas fa-file-alt text-muted me-2"></i>
                                                {{ $backup['name'] }}
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $backup['size_formatted'] }}</span>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $backup['date'] }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $backup['date_human'] }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('backup.download', $backup['name']) }}"
                                                        class="btn btn-outline-info" title="Descargar">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-warning restore-btn"
                                                        data-filename="{{ $backup['name'] }}" title="Restaurar">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger delete-btn"
                                                        data-filename="{{ $backup['name'] }}" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No hay backups disponibles</h5>
                                                <p class="text-muted">Crea tu primer backup usando el botón "Crear Backup"
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para subir backup -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">
                        <i class="fas fa-upload me-2"></i>Subir Backup
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="backup_file" class="form-label">Seleccionar archivo de backup</label>
                            <input type="file" class="form-control" id="backup_file" name="backup_file"
                                accept=".sql,.zip" required>
                            <div class="form-text">
                                <i class="fas fa-info-circle"></i>
                                Formatos permitidos: .sql, .zip (Máximo 50MB)
                            </div>
                        </div>
                        <div class="progress" id="uploadProgress" style="display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary" id="uploadBtn">
                            <i class="fas fa-upload"></i> Subir Archivo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Acción
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmAction">
                        <i class="fas fa-check"></i> Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('third_party_scripts')
    <!-- jQuery debe cargarse antes -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Verificar que jQuery esté cargado
        if (typeof jQuery === 'undefined') {
            console.error('jQuery no está cargado');
        }

        $(document).ready(function() {
            console.log('DOM ready - Inicializando eventos de backups');

            // Crear backup
            $('#createBackup').on('click', function(e) {
                e.preventDefault();
                console.log('Botón crear backup clickeado');
                
                const btn = $(this);
                const originalHtml = btn.html();
                
                // Verificar que la ruta existe
                const createUrl = '{{ route("backups.store") }}';
                console.log('URL de creación:', createUrl);
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creando...');

                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        console.log('Enviando petición de creación de backup...');
                    },
                    success: function(response) {
                        console.log('Respuesta exitosa:', response);
                        if (response.success) {
                            showAlert('success', response.message || 'Backup creado exitosamente');
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            showAlert('error', response.message || 'Error al crear backup');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición:', xhr.responseText);
                        const response = xhr.responseJSON;
                        showAlert('error', response?.message || 'Error al crear backup: ' + error);
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalHtml);
                    }
                });
            });

            // Subir backup - Corregido para usar evento click en lugar de modal
            $('#uploadBackupBtn').on('click', function(e) {
                e.preventDefault();
                console.log('Botón subir backup clickeado');
                $('#uploadModal').modal('show');
            });

            // Refresh backups
            $('#refreshBackups').on('click', function(e) {
                e.preventDefault();
                console.log('Botón refresh clickeado');
                
                const btn = $(this);
                const originalHtml = btn.html();
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Actualizando...');
                
                setTimeout(() => {
                    location.reload();
                }, 500);
            });

            // Subir backup - Form submit
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                console.log('Formulario de upload enviado');

                const formData = new FormData(this);
                const btn = $('#uploadBtn');
                const progressBar = $('#uploadProgress');
                const originalBtnHtml = btn.html();

                // Verificar que la ruta existe
                const uploadUrl = '{{ route("backups.upload") }}';
                console.log('URL de upload:', uploadUrl);

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Subiendo...');
                progressBar.show();

                $.ajax({
                    url: uploadUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                const percentComplete = (evt.loaded / evt.total) * 100;
                                progressBar.find('.progress-bar').css('width', percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        console.log('Upload exitoso:', response);
                        if (response.success) {
                            showAlert('success', response.message || 'Archivo subido exitosamente');
                            $('#uploadModal').modal('hide');
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            showAlert('error', response.message || 'Error al subir archivo');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en upload:', xhr.responseText);
                        const response = xhr.responseJSON;
                        showAlert('error', response?.message || 'Error al subir archivo: ' + error);
                    },
                    complete: function() {
                        btn.prop('disabled', false).html(originalBtnHtml);
                        progressBar.hide();
                        progressBar.find('.progress-bar').css('width', '0%');
                        $('#uploadForm')[0].reset();
                    }
                });
            });

            // Restaurar backup
            $(document).on('click', '.restore-btn', function(e) {
                e.preventDefault();
                const filename = $(this).data('filename');
                console.log('Restaurar backup:', filename);
                
                $('#confirmMessage').html(`
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>¡Advertencia!</strong> Esta acción reemplazará todos los datos actuales de la base de datos.
                    </div>
                    <p>¿Estás seguro de que deseas restaurar el backup <strong>"${filename}"</strong>?</p>
                `);
                $('#confirmAction').removeClass('btn-danger').addClass('btn-warning').html(
                    '<i class="fas fa-undo"></i> Restaurar');
                $('#confirmAction').data('action', 'restore').data('filename', filename);
                $('#confirmModal').modal('show');
            });

            // Eliminar backup
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const filename = $(this).data('filename');
                console.log('Eliminar backup:', filename);
                
                $('#confirmMessage').html(
                    `<p>¿Estás seguro de que deseas eliminar el backup <strong>"${filename}"</strong>?</p>`
                );
                $('#confirmAction').removeClass('btn-warning').addClass('btn-danger').html(
                    '<i class="fas fa-trash"></i> Eliminar');
                $('#confirmAction').data('action', 'delete').data('filename', filename);
                $('#confirmModal').modal('show');
            });

            // Confirmar acción
            $('#confirmAction').on('click', function(e) {
                e.preventDefault();
                const action = $(this).data('action');
                const filename = $(this).data('filename');
                const btn = $(this);

                console.log('Confirmar acción:', action, 'para archivo:', filename);

                btn.prop('disabled', true);

                let url = '';
                const data = {
                    _token: '{{ csrf_token() }}'
                };

                if (action === 'restore') {
                    url = '{{ route("backups.restore", ":filename") }}'.replace(':filename', filename);
                } else if (action === 'delete') {
                    url = '{{ route("backups.destroy", ":filename") }}'.replace(':filename', filename);
                }

                console.log('URL de acción:', url);

                $.ajax({
                    url: url,
                    type: action === 'delete' ? 'DELETE' : 'POST',
                    data: data,
                    success: function(response) {
                        console.log('Acción exitosa:', response);
                        if (response.success) {
                            showAlert('success', response.message);
                            $('#confirmModal').modal('hide');
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            showAlert('error', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en acción:', xhr.responseText);
                        const response = xhr.responseJSON;
                        showAlert('error', response?.message || 'Error al realizar la acción: ' + error);
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                    }
                });
            });

            // Función para mostrar alertas
            function showAlert(type, message) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';

                const alertHtml = `
                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                        <i class="${icon} me-2"></i>${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

                // Remover alertas existentes
                $('#alertContainer .alert').remove();

                // Agregar nueva alerta
                $('#alertContainer').html(alertHtml);

                // Auto-dismiss después de 5 segundos
                setTimeout(() => {
                    $('.alert').fadeOut();
                }, 5000);
            }

            // Función de debug para verificar elementos
            function debugElements() {
                console.log('=== DEBUG INFO ===');
                console.log('Botón crear backup existe:', $('#createBackup').length > 0);
                console.log('Botón subir backup existe:', $('#uploadBackupBtn').length > 0);
                console.log('Botón refresh existe:', $('#refreshBackups').length > 0);
                console.log('Modal upload existe:', $('#uploadModal').length > 0);
                console.log('Form upload existe:', $('#uploadForm').length > 0);
                console.log('jQuery version:', $.fn.jquery);
            }

            // Llamar debug
            debugElements();
        });
    </script>
@endpush