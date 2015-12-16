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


{{--    <div class="well">
        {!! Form::open(['route'=>'comment.store', 'files' => true]) !!}
        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}

            {!! Form::hidden('post_id', $post->id) !!}
        </div>

        <div class="form-group {{ $errors->has('message')? 'has-error' : '' }}">
            {!! Form::label('message', 'votre message :') !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
        </div>


        <button class="btn btn-primary">Envoyer</button>
        {!! Form::close() !!}

    </div>--}}

@endsection

@section('footer')
    <h2>Footer</h2>
@endsection
