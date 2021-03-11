@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="jumbotron jumbotron-fluid bg-dark pb-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                        <h1 class="mt-5 mb-3">Анализатор страниц</h1>
                        <p>Бесплатно проверяйте сайты на SEO пригодность</p>
                        {{ Form::model($url, ['url' => route('urls.store')]) }}
                            {{ Form::text('name') }}
                            {{ Form::submit('ПРОВЕРИТЬ') }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
