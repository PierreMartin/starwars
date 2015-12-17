@extends('layouts.back')


@section('content')
    <h1>Creer un nouveau porduit</h1>

    <div class="well">
        {!! Form::open(['url' => route('admin.products.store'), 'method' => 'POST', 'files' => true ]) !!}

        <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
            {!! Form::label('title', 'Titre de l\'article') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('content')? 'has-error' : '' }}">
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            {!! $errors->first('content', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('image')? 'has-error' : '' }}">
                    {!! Form::label('image', 'Image :') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                    {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('published_at')? 'has-error' : '' }}">
                    {!! Form::label('published_at', 'Date de création') !!}
                    {!! Form::input('date', 'published_at', \Carbon\Carbon::now()->toDateString(), ['class' => 'form-control']) !!}
                    {!! $errors->first('published_at', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('price')? 'has-error' : '' }}">
                    {!! Form::label('price', 'Prix') !!}
                    {!! Form::input('number', 'price', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('category_id')? 'has-error' : '' }}">
                    {!! Form::label('category_id', 'Catégories associés') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('tags')? 'has-error' : '' }}">
            {!! Form::label('tags[]', 'Tags associés') !!}<br>
            @foreach($tags as $tag)
                {!! Form::checkbox('tags[]', $tag->id, null, ['class' => '']) !!} &nbsp; {{ $tag->name }} <br>
            @endforeach
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('status', '1', null) !!} Mettre en ligne
                </label>
            </div>
        </div>

        <button class="btn btn-primary">Envoyer</button>

        {!! Form::close() !!}
    </div>
@endsection



