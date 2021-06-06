@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if ($flash)
        <div class="alert alert-success" role="alert">
            {{ $flash }}
        </div>
    @endif
    <div class="container">
        <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Date of creation') }}</th>
                            <th scope="col">{{ __('Date of update') }}</th>
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
        <h2 class="mt-5 mb-3">{{ __('Checks') }}</h2>
            {{ Form::open(['url' => route('urls.checks.store', [$url->id])]) }}
                {{ Form::submit(__('Run check'), ['class' => 'btn btn-lg btn-primary mb-3']) }}
            {{ Form::close() }}
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('Status code') }}</th>
                            <th scope="col">h1</th>
                            <th scope="col">keywords</th>
                            <th scope="col">description</th>
                            <th scope="col">{{ __('Date of creation') }}</th>
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
    </div>
@endsection