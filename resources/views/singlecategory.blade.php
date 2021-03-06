@extends('layouts/front')

@section('content')

<div class="row">
    <div class="col-12">
        <h2 class="title">{{ $category->name }}</h2>
        <hr>
    </div>
</div>

<div class="row">
    @forelse($category->products as $product)

    <div class="col-md-4">
        <div class="card">
            @if($product->photos()->count())

            <img class="card-img-top" src="{{ asset('storage/' . $product->photos()->first()->image) }}" alt="">

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

    @empty

    <div class="col-12">
        <p>Categoria não possui produtos cadastrados...</p>
    </div>

    @endforelse
</div>
@endsection
