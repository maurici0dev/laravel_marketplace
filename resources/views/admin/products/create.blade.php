@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Criação de Produto</h1>

<form action="{{ route('admin.products.store') }}" method="post">

    @csrf

    <div class="form-group mb-3">
        <label for="name">Nome do produto:</label>
        <input type="text" id="name" name="name" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="description">Descrição:</label>
        <input type="text" id="description" name="description" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="body">Conteúdo:</label>
        <textarea id="body" name="body" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="stores">Lojas:</label>
        <select id="stores" name="store_id" class="form-control">
            @foreach($stores as $store)
            <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-success">Criar Produto</button>
    </div>

</form>
@endsection
