@extends('layouts.app')

@section('content')

<h1 class="title mb-4">Lojas</h1>

@if(!$store)
<a href="{{ route('admin.stores.create') }}" class="btn btn-success mb-3">Criar nova</a>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Total de produtos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td>{{ $store->products->count() }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="post">
                        <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </div>
            </td>
        </tr>
    </tbody>
</table>
@endsection
