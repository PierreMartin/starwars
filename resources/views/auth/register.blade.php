@extends('layouts.back')

@section('content')
    <h1>S'enregister</h1>

    <div class="well">
        <form method="POST" action="/auth/register">
            {!! csrf_field() !!}

            <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
                Nom
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                Email
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                Mot de passe
                <input type="password" name="password" class="form-control">
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password_confirmation')? 'has-error' : '' }}">
                Confirmation du mot de passe
                <input type="password" name="password_confirmation" class="form-control">
                {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
            </div>

            <div>
                <button class="btn btn-primary" type="submit">S'enregister !</button>
            </div>
        </form>
    </div>
@endsection
