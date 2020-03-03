@extends('layouts.datatable')

@section('table')
    <a href="{{ route('orders.new.index') }}">Страница формирования нового заказа</a>
    <table id="orders-table" class="table w-100" data-ajax-url="{{ $ajax }}">
        <thead>
        <tr>
            <th scope="col">№ заказа</th>
            <th scope="col">Дата заказа</th>
            <th scope="col">Общая сумма</th>
            <th scope="col">Контрагент</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
    </table>
@endsection
