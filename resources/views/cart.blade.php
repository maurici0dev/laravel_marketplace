@extends('layouts/front')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="title">Carrinho de compras</h2>
        <hr>
    </div>
    <div class="col-12">
        @if($products)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>R$ {{ number_format($product['price'], '2', ',', '.') }}</td>
                    <td>{{ $product['amount'] }}</td>
                    <td>R$ {{ number_format($product['price'] * $product['amount'], '2', ',', '.') }}</td>
                    <td>
                        <a href="{{ route('cart.remove', ['slug' => $product['slug']]) }}" class="btn btn-danger">Remover</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3">Total:</th>
                    <td colspan="2">R$ 1.000,00</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('cart.cancel') }}" class="btn btn-danger float-left">Cancelar</a>
                <a href="" class="btn btn-success float-right">Finalizar</a>
            </div>
        </div>
        @else
        <div class="alert alert-warning">Carrinho vazio!</div>
        @endif
    </div>
</div>
@endsection
