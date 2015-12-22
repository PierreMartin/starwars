@extends('layouts.front')

@section('content')
    <h1>{{ $product->title }}</h1>
    @if($product->image)
        <a href="{{ url('post', $product->id) }}"><img src="{{ url($product->image->uri) }}" alt="image_laravel"/></a>
    @endif
    <p>{{ $product->content }}</p>
    <p>{{ $product->published_at }}</p>
    <p>{{ $product->price }} €</p>


    @if($product->category)
        <p>categorie : <a href="{{ url('categorie', $product->category->id) }}">{{ $product->category->title }}</a></p>
    @endif

    @if($product->tags)
        Tags associés :
        <ul>
            @foreach($product->tags as $tag)
                <li>{{$tag->name}}</li>
            @endforeach
        </ul>
    @endif


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



@endsection

@section('footer')
    <h2>Footer</h2>
@endsection
