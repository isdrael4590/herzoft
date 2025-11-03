<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') || {{ config('app.name') }}</title>
    <meta content="herZoft" name="author">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Favicon -->
    <link rel="icon" href="{{ settings()->getFirstMediaUrl('settings') }}">

    @include('includes.main-css')

    <!-- stack css -->
    <style>
        .license-notification {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 99999 !important;
            animation: slideUp 0.5s ease-out;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .license-notification.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .license-notification.danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            animation: pulse 2s infinite;
        }

        .license-notification .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
        }

        .license-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .license-icon {
            font-size: 24px;
        }

        .license-text {
            font-size: 14px;
            font-weight: 500;
        }

        .license-days {
            font-size: 20px;
            font-weight: bold;
            padding: 5px 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            margin-left: 10px;
        }

        .license-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .license-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .license-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .license-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer !important;
            transition: all 0.3s;
            font-size: 18px;
            line-height: 1;
            pointer-events: auto !important;
            user-select: none;
            -webkit-user-select: none;
        }

        .license-close:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }

        .license-close:active {
            transform: scale(0.95);
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(100%);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.85;
            }
        }

        .c-body {
            padding-bottom: 70px !important;
            min-height: calc(100vh - 70px);
        }

        .c-wrapper {
            padding-bottom: 70px !important;
        }

        .c-main {
            margin-bottom: 70px !important;
        }
    </style>

</head>

<body class="c-app">
    @include('layouts.sidebar')

    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            @include('layouts.header')
            <div class="c-subheader justify-content-between px-3">
                @yield('breadcrumb')
            </div>
        </header>

        <div class="c-body">
            <main class="c-main">
                @yield('content')
            </main>
        </div>
        @include('layouts.footer')
    </div>

    {{-- Notificación de Licencia --}}
    @php
        use Modules\Setting\Entities\Licence;

        $licence = Licence::first();
        $showNotification = false;
        $daysRemaining = null;

        if ($licence && $licence->shouldShowNotification()) {
            $showNotification = true;
            $daysRemaining = $licence->days_remaining;
        }
    @endphp

    @if ($showNotification)
        <div class="license-notification {{ $daysRemaining <= 7 ? 'danger' : ($daysRemaining <= 15 ? 'warning' : '') }}"
            id="licenseNotification">
            <div class="container-fluid">
                <div class="license-content">
                    <span class="license-icon">
                        @if ($daysRemaining == 0)
                            🔴
                        @elseif($daysRemaining <= 3)
                            ⚠️
                        @elseif($daysRemaining <= 7)
                            ⏰
                        @else
                            ⚡
                        @endif
                    </span>
                    <div>
                        <div class="license-text">
                            @if ($daysRemaining == 0)
                                <strong>¡Su licencia expira HOY!</strong> El sistema podría dejar de funcionar.
                            @elseif($daysRemaining == 1)
                                <strong>¡Su licencia expira MAÑANA!</strong> Renueve su licencia urgentemente.
                            @elseif($daysRemaining <= 7)
                                <strong>¡Atención!</strong> Su licencia está por vencer pronto.
                            @else
                                <strong>Recordatorio:</strong> Su licencia está próxima a vencer.
                            @endif
                        </div>
                        <div class="license-text" style="font-size: 12px; opacity: 0.9;">
                            Fecha de vencimiento: {{ $licence->license_expiration_date->format('d/m/Y') }}
                        </div>
                    </div>
                    <span class="license-days">
                        {{ $daysRemaining }} {{ $daysRemaining == 1 ? 'día' : 'días' }}
                    </span>
                </div>
                <div class="license-actions">
                    @can('access_admin')
                        <a href="{{ route('settings.licence.index') }}" class="license-btn">
                            <i class="fas fa-cog"></i> Renovar
                        </a>
                    @endcan
                    <button class="license-close" type="button" onclick="closeLicenseNotification(); return false;"
                        title="Cerrar notificación">
                        ✕
                    </button>
                </div>
            </div>
        </div>
    @endif

    @include('includes.main-js')

    <script>
        let notificationClosed = false;

        function closeLicenseNotification() {
            if (notificationClosed) return false;

            const notification = document.getElementById('licenseNotification');
            if (!notification) return false;

            notificationClosed = true;
            notification.style.animation = 'slideDown 0.3s ease-out';

            setTimeout(() => {
                notification.remove();
                document.querySelector('.c-body').style.paddingBottom = '0';
            }, 300);

            return false;
        }
    </script>
</body>

</html>
