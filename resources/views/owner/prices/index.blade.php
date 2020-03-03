@extends('layouts.datatable)

@section('table')
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Загружен</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($prices as $price)
                                <tr>
                                    <th scope="row">{{ $price->id }}</th>
                                    <td><a href="{{ route('owner.items.index', $price->id) }}">{{ $price->name }}</a></td>
                                    <td>{{ $price->created_at }}</td>
                                    <td>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
