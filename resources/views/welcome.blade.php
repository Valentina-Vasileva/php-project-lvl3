@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-dark pb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                        <h1 class="display-3">{{ __('messages.Page analyzer') }}</h1>
                        <p class="lead">{{ __('messages.Check for free if sites can be used for SEO') }}</p>
                        {{ Form::open(['url' => route('urls.store'), 'class' => 'd-flex justify-content-center']) }}
                            {{ Form::text('url[name]', '', ['class' => 'form-control form-control-lg', 'placeholder' => 'https://www.example.com']) }}
                            {{ Form::submit(__('messages.Check'), ['class' => 'btn btn-lg btn-primary ms-3 px-5 text-uppercase']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
