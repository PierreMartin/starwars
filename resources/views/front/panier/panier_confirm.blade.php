@extends('layouts.front')

@section('content')
    <h1>Mon panier - confirmation</h1>

    @if(isset($paniers) || isset($total_order))
        <div class="well">
            <h4><strong>Total à payer : {{ $total_order }} €</strong></h4>
        </div>

        <div class="well">
            <h3>Authentification :</h3>

            {!! Form::open(['url' => route('bag-store'), 'method' => 'POST']) !!}
                <div class="form-group {{ $errors->has('customer_name')? 'has-error' : '' }}">
                    {!! Form::label('customer_name', 'Nom d\'utilisateur') !!}
                    {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('customer_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('customer_email')? 'has-error' : '' }}">
                    {!! Form::label('customer_email', 'Email') !!}
                    {!! Form::text('customer_email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('customer_email', '<span class="help-block">:message</span>') !!}
                </div>
                    {!! Form::hidden('status', true) !!}
                    {!! Form::hidden('commanded_at', \Carbon\Carbon::now()) !!}
                    {!! Form::hidden('total_price', $total_order) !!}

                <button class="btn btn-primary">Valider la commande</button>
                <a href="{{url('bag')}}" class="btn btn-primary">Modifier la commande</a>
            {!! Form::close() !!}
        </div>
    @else
        <p class="text-center empty-page">Votre panier est vide</p>
    @endif

@endsection
