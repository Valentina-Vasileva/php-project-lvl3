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
        <h2 class="mt-5 mb-3">Проверки</h2>
            {{ Form::open(['url' => route('urls.checks.store', [$url->id])]) }}
                {{ Form::submit('Запустить проверку', array('class' => 'btn btn-lg btn-primary mb-3')) }}
            {{ Form::close() }}
        <div class="row">
            <div class="col">
            <table class="table table-hover table-bordered table-responsive">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Код ответа</th>
                        <th scope="col">h1</th>
                        <th scope="col">keywords</th>
                        <th scope="col">description</th>
                        <th scope="col">Дата создания</th>
                    </tr>
                    @if ($urlChecks)
                        @foreach ($urlChecks as $urlCheck)
                            <tr>
                                <td scope="row">{{ $urlCheck->id }}</td>
                                <td>{{ $urlCheck->status_code }}</td>
                                <td>{{ $urlCheck->h1 }}</td>
                                <td>{{ $urlCheck->keywords }}</td>
                                <td>{{ $urlCheck->description }}</td>
                                <td>{{ $urlCheck->created_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection