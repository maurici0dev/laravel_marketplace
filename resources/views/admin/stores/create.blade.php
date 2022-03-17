@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Criação de Loja</h1>

<form action="{{ route('admin.stores.store') }}" method="post">

    @csrf

    <div class="form-group mb-3">
        <label class="form-label" class="form-label" for="name">Nome Loja:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="description">Descrição:</label>
        <input type="text" id="description" name="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror">

        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="phone">Telefone:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">

        @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="mobile_phone">Celular:</label>
        <input type="text" id="mobile_phone" name="mobile_phone" value="{{ old('mobile_phone') }}" class="form-control @error('mobile_phone') is-invalid @enderror">

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control">
    </div>

    <div>
        <button type="submit" class="btn btn-success">Criar Loja</button>
    </div>

</form>
@endsection

@section('jsscript')
@endsection
