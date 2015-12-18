@extends('layouts.front')

@section('content')
    <h1>Mon panier - confirmation</h1>


    <pre>{{ var_dump(Session()->get('key')) }}</pre>
    {{--<pre>{{ Session()->flush()  }}</pre>--}}


    @if($tab_ids)
        @foreach($tab_ids as $product)
            <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>

            @if($product->image)
                {{--<a href="{{ url('product', $product->id) }}">image :<img src="{{ url(asset('uploads/'.$product->image->uri)) }}" alt="image_laravel"/></a>--}}
                <a href="{{ url('product', $product->id) }}"><img src="{{ url($product->image->uri) }}" alt="image_laravel"/></a>
            @endif

            <p>Prix : {{ $product->price }} €</p>
            total : {{ $product->price }}

            quantity : {{ Session()->get("key.product_nb."."3")  }} <br>

            @if($tab_nbs)
                @foreach($tab_nbs as $quantity)
                    quantity : {{ $quantity }} <br>
                @endforeach
            @endif

            <hr>
        @endforeach
    @endif


    @if($tab_nbs)
        @foreach($tab_nbs as $quantity)
            quantity : {{ $quantity }} <br>
        @endforeach
    @endif


    <div>
        <strong>total :  €</strong>
    </div>


    <div class="well">
        {!! Form::open(['url' => route('shop.products.store'), 'method' => 'POST']) !!}
            <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
                {!! Form::label('name', 'nom') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
                {!! Form::label('name', 'email') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>

            {!! Form::hidden('product_id', $product->id) !!}
            <button class="btn btn-primary">Terminé</button>
        {!! Form::close() !!}
    </div>


@endsection

@section('footer')
    <h2>Footer</h2>
@endsection
