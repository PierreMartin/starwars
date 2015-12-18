@extends('layouts.front')

@section('content')
    <h1>Mon panier</h1>


    {{--<pre>{{ var_dump(Session()->get('key')) }}</pre>--}}
    {{--<pre>{{ Session()->flush()  }}</pre>--}}
    {{--<pre>{{ Session::forget('key[$key]');   }}</pre>--}}


    @if($tab_product)
        @foreach($tab_product as $key => $product)
            <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>

            @if($product->image)
                {{--<a href="{{ url('product', $product->id) }}">image :<img src="{{ url(asset('uploads/'.$product->image->uri)) }}" alt="image_laravel"/></a>--}}
                <a href="{{ url('product', $product->id) }}"><img src="{{ url($product->image->uri) }}" alt="image_laravel"/></a>
            @endif
            <p>Quantités : {{ $tab_quantity[$key] }}</p>
            <p>Prix : <bold>{{ $product->price }} €</bold></p>
            <p>Prix total de ce produit : <bold>{{ $price_by_product = $product->price * $tab_quantity[$key] }} €</bold></p>

            {{--{!! Form::open(['method' => 'post', 'url' => route('shop.products.deleteProduct', $product) ]) !!}
                <button class="btn btn-warning">Supprimer</button>
                {!! Form::hidden('product_id', $product->id) !!}
            {!! Form::close() !!}--}}
            <hr>
        @endforeach
    @endif


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


    <a href="{{url('bag-confirm')}}" class="btn btn-primary">Terminé</a>


@endsection

@section('footer')
    <h2>Footer</h2>
@endsection
