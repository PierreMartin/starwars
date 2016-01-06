@extends('layouts.front')

@section('content')
    <h1>Contactez-nous</h1>

    <div class="well">
        {!! Form::open(['url' => url('contact') ]) !!}
            <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                {!! Form::label('email', 'Votre email') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('message')? 'has-error' : '' }}">
                {!! Form::label('message', 'Votre message') !!}
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
            </div>

            <button class="btn btn-primary">Envoyer</button>
        {!! Form::close() !!}
    </div>

@endsection

@section('footer')
    <h2>Footer</h2>
@endsection



