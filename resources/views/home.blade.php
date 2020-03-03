@extends('layouts.test-form')

@section('content')
<div class="col-md-5">
    <p class="text-center">SendOrdersData</p>
    <form action="/sendOrdersData" method="post">
        <div style="margin-top: 15%;" class="input-group mb-3">
            <div class="input-group-prepend col-xs-12">
                <span style="color: white;" class="input-group-text bg-dark" id="basic-addon1">Введите Id: </span>
            </div>
            <input type="text" name="ordersGuid" class="form-control"  aria-describedby="basic-addon1">
        </div>
        <input type="submit" class="btn btn-success container" value="Получить товар" >
    </form>
    <p class="text-center">GetOrdersData</p>
    <form action="/getOrdersData" method="post">
        <div style="margin-top: 15%;" class="input-group mb-3">
            <div class="input-group-prepend col-xs-12">
                <span style="color: white;" class="input-group-text bg-dark" id="basic-addon1">Введите Id: </span>
            </div>
            <input type="text" name="userGuid" class="form-control"  aria-describedby="basic-addon1">
        </div>
        <input type="submit" class="btn btn-success container" value="Получить товар" >
    </form>
</div>
@endsection
