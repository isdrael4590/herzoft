<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Setting\Entities\Licence;
use Modules\Setting\Http\Requests\StoreLicencesRequest;

class LicenceController extends Controller
{
    /**
     * Display the licence settings form.
     * @return Renderable
     */
    public function index()
    {
        abort_if(Gate::denies('access_settings'), 403);

        $licence = Licence::first();

        if (!$licence) {
            $licence = new Licence();
        }

        // Contar usuarios que están bloqueados
        $blockedUsersCount = 0;
        if ($licence->isExpired()) {
            $blockedUsersCount = \App\Models\User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'Super Admin']);
            })->count();
        }

        return view('setting::licence.index', compact('licence', 'blockedUsersCount'));
    }

    /**
     * Update the licence settings.
     * @param StoreLicencesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreLicencesRequest $request)
    {
        abort_if(Gate::denies('access_settings'), 403);

        try {
            DB::transaction(function () use ($request) {
                // Usar firstOrCreate en lugar de firstOrFail
                $licence = Licence::firstOrNew();

                $licence->license_expiration_date = $request->license_expiration_date;
                $licence->license_notification_enabled = $request->has('license_notification_enabled');
                $licence->save();

                // Limpiar caché
                Cache::forget('licence_settings');
            });

            // Calcular días restantes para mensaje personalizado
            $licence = Licence::first();
            $daysRemaining = $licence->days_remaining;

            // Mensaje dinámico según días restantes
            if ($daysRemaining <= 7) {
                toast("⚠️ Licencia actualizada. Vence en {$daysRemaining} días.", 'warning');
            } elseif ($daysRemaining <= 15) {
                toast("⚡ Licencia actualizada. Vence en {$daysRemaining} días.", 'info');
            } else {
                toast("✅ Licencia actualizada correctamente. Vence en {$daysRemaining} días.", 'success');
            }
        } catch (\Exception $e) {
            toast('Error al actualizar la licencia: ' . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
        }

        return redirect()->route('settings.licence.index');
    }

    /**
     * Get licence information (for AJAX requests or API)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLicenceInfo()
    {
        $licence = Licence::first();

        if (!$licence || !$licence->shouldShowNotification()) {
            return response()->json(['show' => false]);
        }

        return response()->json([
            'show' => true,
            'days_remaining' => $licence->days_remaining,
            'expiration_date' => $licence->license_expiration_date->format('d/m/Y'),
            'status' => $licence->status,
            'status_color' => $licence->status_color,
            'status_text' => $licence->status_text,
        ]);
    }

    /**
     * Check if licence is expired (middleware usage)
     * @return bool
     */
    public function checkExpiration()
    {
        $licence = Licence::first();

        if (!$licence || !$licence->license_expiration_date) {
            return response()->json([
                'expired' => false,
                'message' => 'Licencia no configurada'
            ]);
        }

        $isExpired = $licence->license_expiration_date->isPast();

        return response()->json([
            'expired' => $isExpired,
            'days_remaining' => $licence->days_remaining,
            'expiration_date' => $licence->license_expiration_date->format('d/m/Y'),
            'message' => $isExpired ? 'Licencia expirada' : 'Licencia activa'
        ]);
    }
}
