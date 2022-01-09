@extends('layout')

@section('content')
    <h1>ブックマークの登録</h1>
    {{ Form::open(['route' => 'shop.store']) }}
        <div class='form-group'>
            {{ Form::label('name', 'タイトル:') }}
            {{ Form::text('name', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('address', 'URL:') }}
            {{ Form::text('address', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('message', 'コメント:') }}
            {{ Form::text('message', null) }}
        </div>
        <div class="form-group">
            {{ Form::submit('登録する', ['class' => 'btn btn-outline-primary']) }}
        </div>
    {{ Form::close() }}

@endsection
