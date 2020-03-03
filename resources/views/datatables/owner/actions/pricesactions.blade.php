<a id="priceDelete" data-id="{{ $price->id }}" class="btn btn-warning h-30" href="#">Удалить</a>
<div class="custom-control custom-switch pl-0">
    <label class="custom-control-inline pr-4" for="hiddenSwitch">Спрятать</label>
    <input data-id="{{ $price->id }}" type="checkbox" class="custom-control-input" id="hiddenSwitch{{ $price->id }}" {{ $price->hidden == '0' ? 'checked' : '' }}>
    <label class="custom-control-label" for="hiddenSwitch{{ $price->id }}">Показать</label>
</div>
