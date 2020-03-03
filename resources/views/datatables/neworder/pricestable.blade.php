@extends('layouts.datatable')
@section('table')
    <table id="buyer-prices-table" class="table" data-ajax-url="{{ $ajax }}">
        <thead>
        <tr>
            <th scope="col">Прайс</th>
        </tr>
        </thead>
    </table>
@endsection
