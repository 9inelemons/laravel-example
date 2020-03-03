@extends('layouts.test-form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Ваши заказы</div>

                    <div class="card-body">
                        <a href="{{ route('orders.new.index') }}">Страница формирования нового заказа</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
