@if($data->status_ciclo === 'Ciclo Correcto')
    <span class="badge" style="background:#16a34a;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_ciclo }}</span>
@elseif($data->status_ciclo === 'En Curso')
    <span class="badge" style="background:#0ea5e9;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_ciclo }}</span>
@elseif($data->status_ciclo === 'Ciclo con Falla')
    <span class="badge" style="background:#dc2626;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_ciclo }}</span>
@elseif($data->status_ciclo === 'Cargar')
    <span class="badge" style="background:#f59e0b;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_ciclo }}</span>
@else
    <span class="badge" style="background:#64748b;color:#fff;padding:5px 10px;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $data->status_ciclo }}</span>
@endif
