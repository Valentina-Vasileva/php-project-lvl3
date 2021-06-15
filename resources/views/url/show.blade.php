@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('messages.Name') }}</th>
                            <th scope="col">{{ __('messages.Date of creation') }}</th>
                            <th scope="col">{{ __('messages.Date of update') }}</th>
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
        <h2 class="mt-5 mb-3">{{ __('messages.Checks') }}</h2>
            {{ Form::open(['url' => route('urls.checks.store', [$url->id])]) }}
                {{ Form::submit(__('messages.Run check'), ['class' => 'btn btn-lg btn-primary mb-3']) }}
            {{ Form::close() }}
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('messages.Status code') }}</th>
                            <th scope="col">h1</th>
                            <th scope="col">keywords</th>
                            <th scope="col">description</th>
                            <th scope="col">{{ __('messages.Date of creation') }}</th>
                        </tr>
                        @if ($urlChecks)
                            @foreach ($urlChecks as $urlCheck)
                                <tr>
                                    <td scope="row">{{ $urlCheck->id }}</td>
                                    <td>{{ $urlCheck->status_code }}</td>
                                    <td>{{ Str::limit($urlCheck->h1, 50) }}</td>
                                    <td>{{ Str::limit($urlCheck->keywords, 50) }}</td>
                                    <td>{{ Str::limit($urlCheck->description, 50) }}</td>
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