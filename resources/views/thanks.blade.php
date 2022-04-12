@extends('layouts/front')

@section('content')
<h1 class="title mb-3">Obrigado por comprar...</h1>
<h3 class="title">Seu pedido foi processado, código do pedido: <strong>{{ request()->get('order') }}</strong></h3>
@if (request()->has('b'))
<hr>
<a href="{{ request()->get('b') }}" class="btn btn-success" target="_blank">Imprimir boleto</a>
@endif
@endsection
