@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Atualizar de Loja</h1>

<form action="{{ route('admin.stores.update', ['store' => $store->id]) }}" method="post">

    @csrf
    @method('put')

    <div class="form-group mb-3">
        <label for="name">Nome Loja:</label>
        <input type="text" id="name" name="name" value="{{ $store->name }}" class="form-control @error('name') is-invalid @enderror">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="description">Descrição:</label>
        <input type="text" id="description" name="description" value="{{ $store->description }}" class="form-control @error('description') is-invalid @enderror">

        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="phone">Telefone:</label>
        <input type="text" id="phone" name="phone" value="{{ $store->phone }}" class="form-control @error('phone') is-invalid @enderror">

        @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="mobile_phone">Celular:</label>
        <input type="text" id="mobile_phone" name="mobile_phone" value="{{ $store->mobile_phone }}" class="form-control @error('mobile_phone') is-invalid @enderror">

        @error('mobile_phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" value="{{ $store->slug }}" class="form-control">
    </div>

    <div>
        <button type="submit" class="btn btn-success">Atualizar Loja</button>
    </div>

</form>
@endsection
