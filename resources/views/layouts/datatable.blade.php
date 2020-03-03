@extends('layouts.test-form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body ">
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
