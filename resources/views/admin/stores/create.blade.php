@extends('layouts.app')

@section('content')
<h1 class="title mb-4">Criação de Loja</h1>

<form action="{{ route('admin.stores.store') }}" method="post">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group mb-3">
        <label for="name">Nome Loja:</label>
        <input type="text" id="name" name="name" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="description">Descrição:</label>
        <input type="text" id="description" name="description" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="phone">Telefone:</label>
        <input type="text" id="phone" name="phone" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="mobile_phone">Celular:</label>
        <input type="text" id="mobile_phone" name="mobile_phone" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="users">Usuário:</label>
        <select id="users" name="user_id" class="form-control">
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-success">Criar Loja</button>
    </div>

</form>
@endsection
