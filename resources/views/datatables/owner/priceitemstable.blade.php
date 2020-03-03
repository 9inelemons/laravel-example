@extends('layouts.datatable')

@section('table')

    <table id="owner-price-items-table" class="table w-100" data-ajax-url="{{ $ajax }}">
        <thead>
        <tr>
            <th scope="col">Артикул</th>
            <th scope="col">Наименование</th>
            <th scope="col">Ед. изм.</th>
            <th scope="col">Цена</th>
        </tr>
        </thead>
    </table>

@endsection

