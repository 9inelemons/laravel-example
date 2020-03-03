@extends('layouts.test-form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Загрузка прайса</div>

                    <div class="card-body">
                        <form action="{{ route('owner.prices.import.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="name">
                                <span>Название прайса</span>
                                <input type="text" name="name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </label>
                            <br>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Загрузка</span>
                                </div>

                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="inputFile" lang="ru">
                                    <label class="custom-file-label" for="inputFile">Выберите файл</label>
                                </div>
                            </div>
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <br>
                            <button class="btn btn-success">Загрузить прайс</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
