@extends('layouts.back')

@section('content')
    <h1>Se connecter</h1>

    <div class="well">
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                Email
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                Mot de passe
                <input type="password" name="password" id="password" class="form-control">
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Rester connecté
                    </label>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Login</button>

        </form>

    </div>
@endsection
