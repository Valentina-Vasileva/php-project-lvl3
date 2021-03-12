@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="jumbotron jumbotron-fluid bg-dark pb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                        <h1 class="display-3">Анализатор страниц</h1>
                        <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
                        {{ Form::model($url, ['url' => route('urls.store'), 'class' => 'd-flex justify-content-center']) }}
                            {{ Form::text('name', '', array('class' => 'form-control form-control-lg', 'placeholder' => 'https://www.example.com')) }}
                            {{ Form::submit('Проверить', array('class' => 'btn btn-lg btn-primary ms-3 px-5 text-uppercase')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
