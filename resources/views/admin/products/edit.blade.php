@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Atualização de Produto</h1>

<form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post">

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
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ $product->slug }}">
    </div>

    <div>
        <button type="submit" class="btn btn-success">Atualizar Produto</button>
    </div>

</form>
@endsection
