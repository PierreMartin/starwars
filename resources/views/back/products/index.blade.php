@extends('layouts.back')


@section('content')
    <div class="add_post">
        <a href="{{url('admin/products/create')}}" class="btn btn-primary">Ajouter un produit</a>
    </div>

    <div class="pagination">
        {!!$products->render()!!}
    </div>

    <table class="table table-striped table-hover ">
        <thead>
        <tr class="info">
            <th>titre</th>
            <th>Extrait</th>
            <th>Catégorie</th>
            <th>Tag(s)</th>
            <th>Créé le</th>
            <th>Publié</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    <strong><a href="{{ url('admin/products/'. $product->id.'/edit') }}">{{ $product->title }}</a></strong>
                </td>

                <td>
                    <p>{{ $product->abstract }}</p>
                </td>

                <td>
                    @if($product->category)
                        {{ $product->category->title }}
                    @endif
                </td>

                <td>
                    @if($product->tags)
                        @foreach($product->tags as $tag)
                            {{ $tag->name }}<br>
                        @endforeach
                    @endif
                </td>

                <td>
                    <p>{{ \Carbon\Carbon::parse($product->published_at)->format('d/m/Y')  }}</p>
                </td>

                <td>
                    @if($product->status == 1)
                        <p>Oui</p>
                    @else
                        <p>Non</p>
                    @endif
                </td>


                <td>
                    {!! Form::open(['url'=>'admin/products/'.$product->id, 'method'=>'DELETE', 'class'=>'form-delete']) !!}
                        <button class="btn btn-warning btn-modal" type="button" name="button">Suprimer</button>

                        <div class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Confirmer ?</h4>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::submit('Supprimer', ['class'=>'btn btn-danger']) !!}
                                        {!! Form::button('Annuler', ['class'=>'btn btn-default btn-cancel']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {!!$products->render()!!}
    </div>
@endsection

