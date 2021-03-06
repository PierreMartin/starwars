@extends('layouts.back')

@section('content')
    <h2>Historique des commandes</h2>
    <a href="{{ url('/admin/unpaid') }}">Voir les commandes non payées</a>
    <br>

    <div class="pagination">
        {!!$orders->render()!!}
    </div>

    <table class="table table-striped table-hover">
        <thead>
        <tr class="info">
            <th>Date</th>
            <th>Client</th>
            <th>Produit(s) commandés</th>
            <th>Prix total</th>
            <th>Statut de la commande</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
            <tr>
                <td>
                    <p>{{ \Carbon\Carbon::parse($order->commanded_at)->format('d/m/Y H:i')  }}</p>
                </td>

                <td>
                    @if($order->customer)
                        {{ $order->customer->username }}
                    @endif
                </td>

                <td>
                    @if($order->products)
                        <ul>
                            @foreach($order->products as $product)
                                <li>{{ $product->pivot->quantity }} - {{ $product->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>

                <td>
                    <p><strong>{{ $order->total_price }} €</strong></p>
                </td>

                <td>
                    @if($order->status == 1)
                        <p>finalisé</p>
                    @else
                        <p>Non finalisé</p>
                    @endif

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {!!$orders->render()!!}
    </div>
@endsection
