@extends('layouts.front')

@section('content')
    <h1>Fiche détail du produit</h1>

    <div class="row">
        <div class="col-sm-12 product_single">

            <section class="content_imagefull">
                @if($product->image)
                    <img src="{{ url(asset('uploads/main/'.$product->image->uri)) }}" alt="image_laravel"/>
                @else
                    <img src="http://lorempixel.com/440/300/?40547" alt="image_laravel"/>
                @endif
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>{{ $product->title }}</h1>
                        <p>{{ $product->content }}</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="priceContainerSingle">
                            <strong class="price">{{ $product->price }} €</strong>
                        </div>
                        <div class="well">
                            {!! Form::open(['url' => route('bag-add'), 'method' => 'POST']) !!}
                            <div class="form-group {{ $errors->has('quantity')? 'has-error' : '' }}">
                                {!! Form::label('quantity', 'Quantitée :') !!}
                                {!! Form::select('quantity', [1, 2, 3, 4, 5], 0, ['class' => 'form-control']) !!}
                                {!! $errors->first('quantity', '<span class="help-block">:message</span>') !!}

                                {!! Form::hidden('product_id', $product->id) !!}
                            </div>
                            <button class="btn btn-primary">Commander</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row infosContainer">
                    <div class="col-md-7">
                        @if($product->category)
                            <p>categorie : <a href="{{ url('categorie', $product->category->id) }}">{{ $product->category->title }}</a></p>
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
    </div>



@endsection
