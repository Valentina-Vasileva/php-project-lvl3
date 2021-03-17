@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="row">
            <div class="col">
                <table class="table table-hover table-bordered table-responsive">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Последняя проверка</th>
                        <th scope="col">Код ответа</th>
                    </tr>
                    @if ($urls)
                        @foreach ($urls as $url)
                            <tr>
                                <td>{{ $url->id }}</td>
                                <td scope="row"><a href="{{ route('urls.show', ['url' => $url->id]) }}">{{ $url->name }}</a></td>
                                <td>{{ $url->last_check }}</td>
                                <td>{{ $url->status_code }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection