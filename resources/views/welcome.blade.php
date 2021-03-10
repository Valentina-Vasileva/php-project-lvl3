@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Анализатор страниц</h1>
    <p>Бесплатно проверяйте сайты на SEO пригодность</p>
    {{ Form::model($url, ['url' => route('urls.store')]) }}
        {{ Form::text('name') }}
        {{ Form::submit('ПРОВЕРИТЬ') }}
    {{ Form::close() }}
@endsection
