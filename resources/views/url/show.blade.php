@extends('layouts.app')

@section('content')
    @if ($flash)
        <div class="alert alert-success" role="alert">
            {{ $flash }}
        </div>
    @endif
    <div class="container">
        <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
        <div class="row">
            <div class="col">
                <table class="table table-hover table-bordered table-responsive">
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