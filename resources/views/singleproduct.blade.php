@extends('layouts/front')

@section('content')
<div class="row">
    <div class="col-4">
        @if($product->photos()->count())
        <img class="card-img-top" src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="image">
        <div class="row">
            @foreach($product->photos as $photo)
            <div class="col-4 mt-4">
                <img class="img-fluid" src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->image }}">
            </div>
            @endforeach
        </div>
        @else
        <img class="card-img-top" src="{{ asset('assets/img/no-photo.jpg') }}" alt="Produto sem foto">
        @endif
    </div>
    <div class="col-8">
        <h2 class="title">{{ $product->name }}</h2>
        <div class="mb-4">
            <p>{{ $product->description }}</p>
            <h3 class="title">R$ {{ number_format($product->price, '2', ',', '.') }}</h3>
            <span>Loja: {{ $product->store->name }}</span>
        </div>
        <div class="product-add">
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="product[name]" value="{{ $product->name }}">
                <input type="hidden" name="product[price]" value="{{ $product->price }}">
                <input type="hidden" name="product[slug]" value="{{ $product->slug }}">
                <div class="form-group">
                    <label class="form-label" for="amount">Quantidade:</label>
                    <input type="number" id="amount" name="product[amount]" value="1" min="1" max="99" class="form-control">
                </div>
                <button type="submit" class="btn btn-danger">Comprar</button>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <hr>
        {{ $product->body }}
    </div>

</div>
@endsection
