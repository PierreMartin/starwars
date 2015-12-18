@extends('layouts.front')

@section('content')
    <h1>Mon panier</h1>


    <pre>{{ var_dump(Session()->get('key')) }}</pre>
    {{--<pre>{{ Session()->flush()  }}</pre>--}}


    @if($tab_ids)
        @foreach($tab_ids as $product)
            <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>

            @if($product->image)
                <a href="{{ url('product', $product->id) }}">image :<img src="{{ url(asset('uploads/'.$product->image->uri)) }}" alt="image_laravel"/></a>
                <a href="{{ url('product', $product->id) }}"><img src="{{ url($product->image->uri) }}" alt="image_laravel"/></a>
            @endif

            <p>Prix : {{ $product->price }} €</p>

            quantity : {{ Session()->get("key.product_nb.1")  }} <br>
            <hr>
        @endforeach
    @endif


    <div>
       {{-- <strong>total : {{ $product->price * $bag_nbs }} €</strong>--}}
    </div>

    <button class="btn btn-primary">Terminer la commande</button>






{{--@section('content')

    @foreach($products as $product)
        <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>
        @if($product->image)
            --}}{{--<a href="{{ url('product', $product->id) }}">image :<img src="{{ url(asset('uploads/'.$product->image->uri)) }}" alt="image_laravel"/></a>--}}{{--
            <a href="{{ url('product', $product->id) }}"><img src="{{ url($product->image->uri) }}" alt="image_laravel"/></a>
        @endif
        <p>{{ $product->abstract }}</p>
        <p>{{ $product->published_at }}</p>
        <p>{{ $product->price }} €</p>

        @if($product->category)
            <p>categorie : <a href="{{ url('category', $product->category->id) }}">{{ $product->category->title }}</a></p>
        @endif

        @if($product->tags)
            Tags associés :
            <ul>
                @foreach($product->tags as $tag)
                    <li><a href="{{ url('tag', $tag->id) }}">{{$tag->name}}</a></li>
                @endforeach
            </ul>
        @endif

        <hr>
    @endforeach

@endsection--}}






{{--<div class="well">
    {!! Form::open(['url' => route('shop.products.store'), 'method' => 'POST']) !!}
    <div class="form-group {{ $errors->has('product_id')? 'has-error' : '' }}">
        {!! Form::label('product_id', 'Quantitée des produits :') !!}
        {!! Form::select('product_id', [0, 1, 2, 3, 4, 5], 1, ['class' => 'form-control']) !!}
        {!! $errors->first('product_id', '<span class="help-block">:message</span>') !!}

        {!! Form::hidden('product_id', $product->id) !!}  enregistrement dans la table "customer_product" -> 'orders'
    </div>
    <button class="btn btn-primary">Commander</button>
    {!! Form::close() !!}

</div>--}}


@endsection

@section('footer')
    <h2>Footer</h2>
@endsection
