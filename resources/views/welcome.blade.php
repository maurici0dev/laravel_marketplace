@extends('layouts.front')

@section('content')
<div class="row">
    @foreach($products as $product)
    <div class="col-md-4">
        <div class="card">
            @if($product->photos()->count())
            <img class="card-img-top" src="{{ asset('storage/' . $product->thumb) }}" alt="">
            @else
            <img class="card-img-top" src="{{ asset('assets/img/no-photo.jpg') }}" alt="Foto padrão">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <p class="card-text">
                    {{ $product->description }}
                </p>
                <h4 class="card-title">R$ {{ number_format($product->price, '2', ',', '.') }}</h4>
                <a href="{{ route('single.product', ['slug' => $product->slug]) }}" class="btn btn-success">Ver produto</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        <h2 class="title">Lojas em destaque:</h2>
        <hr>
    </div>
    @foreach($stores as $store)
    <div class="col-4">

        @if($store->logo)
        <img class="img-fluid" src="{{ asset('storage/' . $store->logo) }}" alt="Logo da loja {{ $store->name }}">
        @else
        <img class="img-fluid" src="https://via.placeholder.com/340x128.png?text={{ $store->name }}" alt="Loja sem logo">
        @endif

        <h3 class="title">{{ $store->name }}</h3>
        <p>{{ $store->description }}</p>
        <a href="{{ route('single.store', ['slug' => $store->slug]) }}" class="btn btn-success">Ver loja</a>
    </div>
    @endforeach
</div>
@endsection
