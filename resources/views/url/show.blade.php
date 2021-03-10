@extends('layouts.app')

@section('content')
    @if ($flash)
        <p>{{ $flash }}</p>
    @endif

@section('content')
    <h1>Сайт: {{ $url->name }}</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                <th>Дата обновления</th>
            </tr>
            <tr>
                <td>{{ $url->id }}</td>
                <td>{{ $url->name }}</td>
                <td>{{ $url->created_at }}</td>
                <td>{{ $url->updated_at }}</td>
            </tr>
        </table>
@endsection