@extends('layouts.test-form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Личный кабинет</div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    <span>Орагнизация</span>
                                </div>
                                <div class="col-sm">
                                    <span>{{ $user->organization }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <span>Ваш ключ доступа</span>
                                </div>
                                <div class="col-sm">
                                    <span>{{ $user->uuid }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
