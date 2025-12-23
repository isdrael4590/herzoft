<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licencia Expirada - Acceso Denegado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fc4a1a 0%, #f7b733 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .expired-container {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 650px;
            width: 100%;
            animation: slideUp 0.5s ease-out;
        }
        .expired-icon {
            font-size: 100px;
            margin-bottom: 20px;
            animation: shake 1s infinite;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.2));
        }
        .expired-title {
            color: #e74c3c;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .expired-subtitle {
            color: #c0392b;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
        }
        .expired-message {
            color: #555;
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #e74c3c;
        }
        .user-info p {
            margin: 5px 0;
            color: #666;
            font-size: 15px;
        }
        .contact-info {
            background: #fff3cd;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px solid #ffc107;
        }
        .contact-info h5 {
            color: #856404;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .contact-info p {
            margin: 8px 0;
            color: #856404;
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes shake {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
        }
        .btn-logout {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }
        .btn-logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
            color: white;
        }
        .btn-logout i {
            margin-right: 8px;
        }
        .alert-box {
            background: #fee;
            border-left: 5px solid #e74c3c;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }
        .alert-box strong {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="expired-container">
        <div class="expired-icon">🔒</div>
        <h1 class="expired-title">⚠️ Acceso Denegado ⚠️</h1>
        <h2 class="expired-subtitle">Licencia del Sistema Expirada</h2>
        
        <div class="alert-box">
            <strong><i class="fas fa-exclamation-circle"></i> Sistema Bloqueado:</strong>
            La licencia de este software ha caducado y el acceso está restringido.
        </div>

        @if(isset($user))
        <div class="user-info">
            <p><strong><i class="fas fa-user"></i> Usuario:</strong> {{ $user->name }}</p>
            <p><strong><i class="fas fa-envelope"></i> Email:</strong> {{ $user->email }}</p>
            <p><strong><i class="fas fa-shield-alt"></i> Rol:</strong> 
                @foreach($user->roles as $role)
                    <span class="badge bg-secondary">{{ $role->name }}</span>
                @endforeach
            </p>
        </div>
        @endif

        <p class="expired-message">
            <strong>Su cuenta no tiene permisos suficientes para acceder al sistema con la licencia expirada.</strong>
            <br><br>
            Solo los administradores del sistema pueden acceder durante este período.
            <br>
            Por favor, contacte a su administrador para que renueve la licencia.
        </p>
        
        @if(isset($licence) && $licence->license_expiration_date)
        <div class="alert-box">
            <strong><i class="fas fa-calendar-times"></i> Fecha de Expiración:</strong>
            {{ $licence->license_expiration_date->format('d/m/Y') }}
            (Expiró hace {{ now()->diffInDays($licence->license_expiration_date) }} días)
        </div>
        @endif

        <div class="contact-info">
            <h5><i class="fas fa-phone-volume"></i> Contacte al Administrador</h5>
            <p><i class="fas fa-envelope"></i> <strong>Email:</strong>  {{ Settings()->company_email }} </p>
            <p><i class="fas fa-phone"></i> <strong>Teléfono:</strong>  {{ Settings()->company_phone }} </p>
            <p><i class="fas fa-clock"></i> <strong>Horario:</strong> Lun - Vie, 8:00 AM - 5:00 PM</p>
        </div>

        <div style="margin-top: 30px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>

        <p style="margin-top: 25px; color: #999; font-size: 13px;">
            <i class="fas fa-info-circle"></i> Este mensaje se mostrará hasta que la licencia sea renovada por un administrador
        </p>
    </div>
</body>
</html>