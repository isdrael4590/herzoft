@foreach(\Modules\Stock\Entities\Stock::all() as $stock)

<option value="{{ $stock->id }}">
    <span class="badge badge-info">{{ $stock->lote_machine . "  ( ". $stock->operator . ")  "}}</span>
</option>
@endforeach

