@extends('layouts.front')

@section('content')
<div class="col-12">
    <h2 class="title">Meus pedidos:</h2>
    <hr>
</div>
<div class="col-12">
    <div class="accordion" id="accordionExample">
        @forelse($userOrders as $key => $order)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $key }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                    Pedido #{{ $order->reference }}
                </button>
            </h2>
            <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <ul>
                        @foreach(unserialize($order->items) as $item)
                        <li> <strong>Produto: </strong> {{ $item['name'] }} | <strong>Preço: </strong>R$ {{ number_format($item['price'], '2', ',', '') }} | <strong>Quantidade: </strong> {{ $item['amount'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <p>Loja sem pedidos</p>
        @endforelse
    </div>
</div>
<div class="col-12">
    <hr>
    {{ $userOrders->links() }}
</div>
</div>
@endsection
