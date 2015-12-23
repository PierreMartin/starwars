@extends('layouts.front')

@section('content')
    <h1>Mon panier - confirmation</h1>

    @if(isset($tab_product))
        @foreach($tab_product as $key => $product)
            <p><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></p>
            <hr>
        @endforeach
    @endif

    @if(isset($tab_quantity) || isset($total_order) )
        <table class="table table-striped table-hover ">
            <thead>
            <tr class="info">
                <th>Nombre de produits différent</th>
                <th>Prix total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <p><strong>{{ count($tab_quantity) }}</strong></p>
                </td>
                <td>
                    <p><strong>{{ $total_order }} €</strong></p>
                </td>
            </tr>
            </tbody>
        </table>
    @endif


    <div class="well">
        <h3>Authentification :</h3>
        {{-- step 1 : on verifier que les 2 champs match bien dans la bdd --}}
        {{-- step 2 : on save les champs en bdd -> table 'orders' --}}

        {!! Form::open(['url' => route('bag-store'), 'method' => 'POST']) !!}
            <div class="form-group {{ $errors->has('customer_name')? 'has-error' : '' }}">
                {!! Form::label('customer_name', 'nom d\'utilisateur') !!}
                {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('customer_name', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('customer_email')? 'has-error' : '' }}">
                {!! Form::label('customer_email', 'email') !!}
                {!! Form::text('customer_email', null, ['class' => 'form-control']) !!}
                {!! $errors->first('customer_email', '<span class="help-block">:message</span>') !!}
            </div>
                {!! Form::hidden('status', true) !!}
                {!! Form::hidden('commanded_at', \Carbon\Carbon::now()) !!}
                {!! Form::hidden('total_price', $total_order) !!}

            <button class="btn btn-primary">Commander</button>
            <a href="{{url('bag')}}" class="btn btn-primary">Modifier la commande</a>
        {!! Form::close() !!}
    </div>

@endsection

@section('footer')
    <h2>Footer</h2>
@endsection




