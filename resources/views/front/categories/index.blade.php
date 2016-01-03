@extends('layouts.front')

@section('content')
    <div class="pagination">
        {!!$products->render()!!}
    </div>

    @foreach($products as $product)
        <h2><a href="{{ url('product', $product->id) }}">{{ $product->title }}</a></h2>
        @if($product->image)
            <a href="{{ url('product', $product->id) }}"><img src="{{ url(asset('uploads/preview/'.$product->image->uri_preview)) }}" alt="image_laravel"/></a>
        @endif
        <p>{{ $product->abstract }}</p>
        <p>Produit ajouté le {{ \Carbon\Carbon::parse($product->published_at)->format('d/m/Y') }}</p>
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

    <div class="pagination">
        {!!$products->render()!!}
    </div>
@endsection

@section('footer')
    <h2>Footer</h2>
@endsection



