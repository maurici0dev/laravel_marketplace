@extends('layouts.app')

@section('content')

<h1 class="title mb-4">Notifica&ccedil;&otilde;es</h1>

<a href="{{ route('admin.notifications.read.all') }}" class="btn btn-success mb-3">Marcar todas como lidas</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Notifição</th>
            <th>Criado</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @forelse($unreadNotifications as $key => $n)
        <tr>
            <td>{{ $key }}</td>
            <td>{{ $n->data['message'] }}</td>
            <td>{{ $n->created_at }}</td>
            <td>
                <a class="btn btn-danger" href="{{ route('admin.notifications.read', ['id' => $n->id]) }}">Marcar como lida</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                Nenuma notificação encontrada.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
