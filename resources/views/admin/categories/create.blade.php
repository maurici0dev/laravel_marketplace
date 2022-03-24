@extends('layouts.app')


@section('content')
<h1 class="title mb-4">Criar Categoria</h1>

<form action="{{route('admin.categories.store')}}" method="post">

    @csrf

    <div class="form-group mb-3">
        <label class="form-label" for="name">Nome</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="description">Descrição</label>
        <input type="text" is="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div>
        <button type="submit" class="btn btn-success">Criar Categoria</button>
    </div>
</form>
@endsection
