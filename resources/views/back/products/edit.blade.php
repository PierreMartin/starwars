@extends('layouts.back')


@section('content')
    <h1>Modifier un produit</h1>

    <div class="well">
        {!! Form::open(['method' => 'put', 'url' => route('admin.products.update', $product), 'files' => true ]) !!}

        <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
            {!! Form::label('title', 'Titre de l\'article') !!}
            {!! Form::text('title', $product->title, ['class' => 'form-control']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('content')? 'has-error' : '' }}">
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', $product->content, ['class' => 'form-control']) !!}
            {!! $errors->first('content', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label>Image (taille optimale : supérieure à 970px par 450px)</label><br>
                @if($product->image)
                    <img src="{{ url(asset('uploads/preview/'.$product->image->uri_preview)) }}" alt="image_laravel" class="image_preview"/>
                @endif

                <div class="form-group {{ $errors->has('image')? 'has-error' : '' }}">
                    {!! Form::file('image', ['class' => '']) !!}
                    {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('published_at')? 'has-error' : '' }}">
                    {!! Form::label('published_at', 'Date de modification') !!}
                    {!! Form::input('text', 'published_at', $time, ['class' => 'form-control datepicker']) !!}
                    {!! $errors->first('published_at', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('tags')? 'has-error' : '' }}">
                    {!! Form::label('tags[]', 'Tags associés') !!}<br>
                    @foreach($tags as $tag)
                        {!! Form::checkbox('tags[]', $tag->id, $product->hasTags($tag->id) ) !!} &nbsp; {{ $tag->name }} <br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('price')? 'has-error' : '' }}">
                    {!! Form::label('price', 'Prix') !!}
                    {!! Form::input('number', 'price', $product->price, ['class' => 'form-control', 'min' => '0']) !!}
                    {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('category_id')? 'has-error' : '' }}">
                    {!! Form::label('category_id', 'Catégories associés') !!}
                    {!! Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control']) !!}
                    {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('status', '1', $product->status) !!} Mettre en ligne
                </label>
            </div>
        </div>

        <button class="btn btn-primary">Envoyer</button>

        {!! Form::close() !!}
    </div>
@endsection



