@extends('layouts.app')

@if ($flash)
    <div class="alert alert-success" role="alert">
        <p>{{ $flash }}</p>
    </div>
@endif

@section('content')
    <div class="container">
        <h1>Сайт: {{ $url->name }}</h1>
        <div class="row">
            <div class="col">
                <table class="table">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Дата обновления</th>
                    </tr>
                    <tr>
                        <td>{{ $url->id }}</td>
                        <td scope="row">{{ $url->name }}</td>
                        <td>{{ $url->created_at }}</td>
                        <td>{{ $url->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection