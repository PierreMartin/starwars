@extends('layouts.front')

@section('content')
    <h1>Mon panier</h1>


    {{--<pre>{{ var_dump(Session()->get('key')) }}</pre>--}}
    {{--<pre>{{ Session()->flush()  }}</pre>--}}


    @if(isset($tab_product))
        @foreach($tab_product as $key => $product)
            <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>

            @if($product->image)
                {{--<a href="{{ url('product', $product->id) }}">image :<img src="{{ url(asset('uploads/'.$product->image->uri)) }}" alt="image_laravel"/></a>--}}
                <a href="{{ url('product', $product->id) }}"><img src="{{ url($product->image->uri) }}" alt="image_laravel"/></a>
            @endif
            <p>Quantités : {{ $tab_quantity[$key] }}</p>
            <p>Prix : <bold>{{ $product->price }} €</bold></p>
            <p>Prix total de ce produit : <bold>{{ $price_by_product = $product->price * $tab_quantity[$key] }} €</bold></p>
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

        <a href="{{url('bag-confirm')}}" class="btn btn-primary">Terminé la commande</a>
        <a class="btn btn-warning" href="{{ route('bag-delete') }}">Vider le panier</a>
    @endif


@endsection

@section('footer')
    <h2>Footer</h2>
@endsection
