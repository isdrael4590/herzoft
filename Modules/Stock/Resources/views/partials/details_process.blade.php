@foreach(\Modules\Stock\Entities\Stock::all() as $stock)

<option value="{{ $stock->id }}">
    <span class="badge badge-info">{{"Lote Eq.: ". $stock->lote_machine }}</span>
    <span>-></span>
    <span class="badge badge-info">{{"Equipo:  ". $stock->machine_name }}</span>
</option>
@endforeach

