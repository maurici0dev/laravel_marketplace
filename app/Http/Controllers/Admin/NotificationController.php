<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications.index', compact('unreadNotifications'));
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        $notification->markAsRead();

        flash('Notificação lida com sucesso')->success();
        return redirect()->back();
    }

    public function readAll()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
        });

        flash('Notificações lidas com sucesso')->success();
        return redirect()->back();
    }
}
