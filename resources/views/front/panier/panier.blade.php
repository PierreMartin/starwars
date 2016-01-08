@extends('layouts.front')

@section('content')
    <h1>Mon panier</h1>

    @if(isset($paniers) || isset($total_order))
        <div class="well">
            <table class="table table-striped table-hover" style="border: #fff 1px solid;">
                <thead>
                <tr class="">
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix total par produit</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paniers as $key => $panier)
                    <tr>
                        <td>
                            @if($panier["image"])
                                <div class="content_imagemini">
                                    <a href="{{ url('product', $panier["product_id"]) }}"><img src="{{ url(asset('uploads/mini/'.$panier["image"])) }}" alt="image_laravel" width="100" /></a>
                                </div>
                            @else
                                <div class="content_imagemini">
                                    <a href="{{ url('product', $panier["product_id"]) }}"><img src="{{ url(asset('assets/img/default_mini.jpg')) }}" alt="image_laravel"/></a>
                                </div>
                            @endif
                        </td>

                        <td>
                            <h4><a href="{{ url('product', $panier["product_id"]) }}">{{ $panier["title"] }}</a></h4>
                        </td>

                        <td>
                            <p>{{ $panier["quantity"] }}</p>
                        </td>

                        <td>
                            <p><bold>{{ $panier["price"] }} €</bold></p>
                        </td>

                        <td>
                            <p><bold>{{ $panier["priceTotalByProduct"] }} €</bold></p>
                        </td>

                        <td>
                            <a class="btn btn-warning" href="{{ route('product-delete', $key) }}">Supprimer le produit</a>
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
                        <p><strong>{{ $total_products }}</strong></p>
                    </td>
                    <td>
                        <p><strong>{{ $total_order }} €</strong></p>
                    </td>
                </tr>
                </tbody>
            </table>

            <a href="{{url('bag-confirm')}}" class="btn btn-primary">Terminer la commande</a>
            <a class="btn btn-warning" href="{{ route('bag-delete') }}">Vider le panier</a>

        </div>
    @else
        <p class="text-center empty-page">Votre panier est vide</p>
    @endif

@endsection