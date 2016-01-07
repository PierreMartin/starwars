@extends('layouts.front')

@section('content')
    <h1>Les tags</h1>

    <div class="row">
        @forelse($products as $product)
            <div class="col-sm-6 product">
                <section>
                    @if($product->image)
                        <a href="{{ url('product', $product->id) }}"><img src="{{ url(asset('uploads/preview/'.$product->image->uri_preview)) }}" alt="image_laravel"/></a>
                    @else
                        <a href="{{ url('product', $product->id) }}"><img src="{{ url(asset('assets/img/default_preview.jpg')) }}" alt="image_laravel"/></a>
                    @endif
                </section>

                <section class="content">
                    <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>

                    <p>{{ $product->abstract }}</p>

                    <div class="priceContainer">
                        <strong class="price">{{ $product->price }} €</strong>
                        <br>
                        <a href="{{ url('product', $product->id) }}" class="btn btn-success btn-see-product">Voir le produit</a>
                    </div>
                    <hr>

                    <div class="row infosContainer">
                        <div class="col-md-7">
                            @if($product->category)
                                <p>Categorie : <a href="{{ url('categorie', $product->category->id) }}">{{ $product->category->title }}</a></p>
                            @endif

                            @if($product->tags !== 'null')
                                Tags :
                                @foreach($product->tags as $tag)
                                    <a href="{{ url('tag', $tag->id) }}">#{{$tag->name}} </a>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-4">
                            <p>Produit ajouté le {{ \Carbon\Carbon::parse($product->published_at)->format('d/m/Y') }}</p>
                        </div>
                    </div>

                </section>
            </div>
        @empty
            <p class="text-center empty-page">Il n'y a pas de produit pour ce tag</p>
        @endforelse
    </div>

@endsection

@section('footer')
    <h2>Footer</h2>
@endsection



