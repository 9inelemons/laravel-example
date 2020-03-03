@extends('layouts.datatable')
@section('table')
    <table id="owner-prices-table" class="table" data-ajax-url="{{ $ajax }}">
        <thead>
        <tr>
            <th scope="col">Прайс</th>
            <th scope="col">Видимость для других</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
    </table>
@endsection
