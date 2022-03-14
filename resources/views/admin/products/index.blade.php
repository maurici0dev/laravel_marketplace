@extends('layouts.app')

@section('content')

<h1 class="title mb-4">Produtos</h1>

<a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Criar novo</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>R$ {{ number_format($product->price, 2, ",", ".") }}</td>
            <td>{{ $product->store->name }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }}
@endsection
