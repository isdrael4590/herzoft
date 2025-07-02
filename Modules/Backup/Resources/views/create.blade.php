@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create New Backup</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('backups.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="backup_name" class="form-label">Backup Name (Optional)</label>
                            <input type="text" 
                                   class="form-control @error('backup_name') is-invalid @enderror" 
                                   id="backup_name" 
                                   name="backup_name" 
                                   value="{{ old('backup_name') }}"
                                   placeholder="Leave empty for auto-generated name">
                            @error('backup_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                If left empty, a timestamp-based name will be generated automatically.
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="compress_backup" 
                                   name="compress_backup" 
                                   value="1" 
                                   {{ old('compress_backup') ? 'checked' : '' }}>
                            <label class="form-check-label" for="compress_backup">
                                Compress backup (recommended)
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('backups.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create Backup
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Upload Backup Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Upload Backup</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('backups.upload') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="backup_file" class="form-label">Select Backup File</label>
                            <input type="file" 
                                   class="form-control @error('backup_file') is-invalid @enderror" 
                                   id="backup_file" 
                                   name="backup_file" 
                                   accept=".sql,.gz,.zip">
                            @error('backup_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                Accepted formats: .sql, .sql.gz, .zip
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Upload Backup
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection