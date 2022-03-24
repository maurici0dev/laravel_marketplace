@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Criação de Produto</h1>

<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">

    @csrf

    <div class="form-group mb-3">
        <label class="form-label" for="name">Nome do produto:</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="description">Descrição:</label>
        <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror">

        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="body">Conteúdo:</label>
        <textarea id="body" name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror"></textarea>

        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="price">Preço:</label>
        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror">

        @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="categories">Categoria</label>
        <select type="text" id="categories" name="categories[]" class="form-control" multiple>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="photos">Fotos:</label>
        <input type="file" id="photos" name="photos[]" class="form-control @error('photos') is-invalid @enderror" multiple>

        @error('photos')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <button type="submit" class="btn btn-success">Criar Produto</button>
    </div>

</form>
@endsection
