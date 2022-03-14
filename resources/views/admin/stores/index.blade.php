@extends('layouts.app')

@section('content')

<h1 class="title mb-4">Lojas</h1>

<a href="{{ route('admin.stores.create') }}" class="btn btn-success mb-3">Criar nova</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stores as $store)
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="post">
                        <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $stores->links() }}
@endsection
