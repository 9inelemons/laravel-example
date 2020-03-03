@extends('layouts.datatable')

@section('table')
    <table id="organizations-table" class="table" data-ajax-url="{{ $ajax }}">
        <thead>
        <tr>
            <th scope="col">Организация</th>
            <th scope="col">Описание</th>
        </tr>
        </thead>
    </table>
@endsection
