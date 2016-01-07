@extends('layouts.front')

@section('content')
    <h1>Mon panier</h1>

    @if(isset($tab_product) || isset($tab_quantity) || isset($total_order) )
        <div class="well">
            <table class="table table-striped table-hover" style="border: #fff 1px solid;">
                <thead>
                <tr class="">
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix total par produit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tab_product as $key => $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <div class="content_imagemini">
                                    <a href="{{ url('product', $product->id) }}"><img src="{{ url(asset('uploads/mini/'.$product->image->uri_mini)) }}" alt="image_laravel" width="100" /></a>
                                </div>
                            @else
                                <div class="content_imagemini">
                                    <a href="{{ url('product', $product->id) }}"><img src="{{ url(asset('assets/img/default_mini.jpg')) }}" alt="image_laravel"/></a>
                                </div>
                            @endif


                        </td>

                        <td>
                            <h4><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h4>
                        </td>

                        <td>
                            <p>{{ $tab_quantity[$key] }}</p>
                        </td>

                        <td>
                            <p><bold>{{ $product->price }} €</bold></p>
                        </td>

                        <td>
                            <p><bold>{{ $price_by_product = $product->price * $tab_quantity[$key] }} €</bold></p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table table-striped table-hover">
                <thead>
                <tr class="danger">
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

        </div>
    @else
        <p class="text-center empty-page">Votre panier est vide</p>
    @endif



@endsection