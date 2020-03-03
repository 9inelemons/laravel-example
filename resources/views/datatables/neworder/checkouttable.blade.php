@extends('layouts.datatable')

@section('table')
    <a class="btn btn-success mb-3 w-100" href="{{ route('orders.new.confirmOrder') }}">Отправить заказ</a>
    <div class="order-info">
        <span>Организация: <b>{{ $organization->organization }}</b></span>
        <br>
        <span>Прайс: <b>{{ $price->name }}</b></span>
    </div>
    <table id="checkout-price-items-table" class="table w-100" data-ajax-url="{{ $ajax }}">
        <thead>
        <tr>
            <th scope="col">Артикул</th>
            <th scope="col">Наименование</th>
            <th scope="col">Ед. изм.</th>
            <th scope="col">Цена</th>
            <th scope="col">Действия</th>
            <th scope="col">Количество</th>
        </tr>
        </thead>
    </table>

        <div class="mt-3 mb-3 flex-xl-column">
            <div class="d-flex justify-content-center">
                <span>Сумма заказа:</span>
                <span id="subTotal"></span>
            </div>
            <a class="btn btn-success w-100" href="{{ route('orders.new.confirmOrder') }}">Отправить заказ</a>
        </div>

@endsection

