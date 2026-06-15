@if($data->status_indicador === 'Correcto')
    <span class="badge" style="background:#16a34a;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_indicador }}</span>
@elseif($data->status_indicador === 'Sin Validar')
    <span class="badge" style="background:#6366f1;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_indicador }}</span>
@elseif($data->status_indicador === 'Falla')
    <span class="badge" style="background:#dc2626;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_indicador }}</span>
@else
    <span class="badge" style="background:#64748b;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_indicador }}</span>
@endif
