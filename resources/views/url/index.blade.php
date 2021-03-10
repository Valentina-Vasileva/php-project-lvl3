@extends('layouts.app')

@section('content')
    <h1>Сайты</h1>
    @if ($urls)
        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
            </tr>
            @foreach ($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td><a href="{{ route('urls.show', ['url' => $url->id]) }}">{{ $url->name }}</a></td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection