@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3">{{ __('Sites') }}</h1>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Last check') }}</th>
                            <th scope="col">{{ __('Status code') }}</th>
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
    </div>
@endsection