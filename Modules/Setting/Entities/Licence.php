<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Licence extends Model
{
    use HasFactory;

    // IMPORTANTE: Especificar el nombre correcto de la tabla
    protected $table = 'licence_expirations';

    protected $fillable = [
        'license_expiration_date',
        'license_notification_enabled',
    ];

    protected $casts = [
        'license_expiration_date' => 'date',
        'license_notification_enabled' => 'boolean',
    ];

    /**
     * Obtener la licencia activa (primera o única)
     */
    public static function getActiveLicense()
    {
        return self::first();
    }

    /**
     * Obtener días restantes hasta el vencimiento
     */
    public function getDaysRemainingAttribute()
    {
        if (!$this->license_expiration_date) {
            return null;
        }
        return now()->diffInDays($this->license_expiration_date, false);
    }

    /**
     * Verificar si debe mostrar notificación
     */
    public function shouldShowNotification()
    {
        if (!$this->license_notification_enabled || !$this->license_expiration_date) {
            return false;
        }

        $daysRemaining = $this->days_remaining;
        return $daysRemaining !== null && $daysRemaining <= 30 && $daysRemaining >= 0;
    }

    /**
     * Obtener el estado de la licencia
     */
    public function getStatusAttribute()
    {
        if (!$this->license_expiration_date) {
            return 'not_configured';
        }

        $daysRemaining = $this->days_remaining;

        if ($daysRemaining < 0) {
            return 'expired';
        } elseif ($daysRemaining <= 7) {
            return 'critical';
        } elseif ($daysRemaining <= 15) {
            return 'warning';
        } else {
            return 'active';
        }
    }

    /**
     * Obtener el color del estado
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'not_configured' => 'secondary',
            'expired' => 'danger',
            'critical' => 'danger',
            'warning' => 'warning',
            'active' => 'success'
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    /**
     * Obtener el texto del estado
     */
    public function getStatusTextAttribute()
    {
        $texts = [
            'not_configured' => 'Sin configurar',
            'expired' => 'Expirada',
            'critical' => 'Crítica',
            'warning' => 'Por vencer',
            'active' => 'Activa'
        ];

        return $texts[$this->status] ?? 'Desconocido';
    }
}