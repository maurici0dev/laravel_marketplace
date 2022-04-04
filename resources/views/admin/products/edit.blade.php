@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Atualização de Produto</h1>

<form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">

    @csrf
    @method('put')

    <div class="form-group mb-3">
        <label for="name">Nome do produto:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}">
    </div>

    <div class="form-group mb-3">
        <label for="description">Descrição:</label>
        <input type="text" id="description" name="description" class="form-control" value="{{ $product->description }}">
    </div>

    <div class="form-group mb-3">
        <label for="body">Conteúdo:</label>
        <textarea id="body" name="body" cols="30" rows="10" class="form-control">{{ $product->body }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" class="form-control" value="{{ $product->price }}">
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="categories">Categoria</label>
        <select type="text" id="categories" name="categories[]" class="form-control" multiple>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if($product->categories->contains($category)) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="photos">Fotos:</label>
        <input type="file" id="photos" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>

        @error('photos.*')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <button type="submit" class="btn btn-success">Atualizar Produto</button>
    </div>

</form>

<hr>

<div class="row">
    @foreach($product->photos as $photo)
    <div class="col-4">
        <img src="{{ asset('storage/' . $photo->image) }}" class="img-fluid">
        <form action="{{ route('admin.photo.remove') }}" method="post">
            @csrf
            <input type="hidden" name="photoName" value="{{ $photo->image }}">
            <button type="submit" class="btn btn-danger">
                Remover
            </button>
        </form>
    </div>
    @endforeach
</div>
@endsection
