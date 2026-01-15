<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Notifikasi - Client Area')]
#[Layout('components.layouts.client')]
class Notifications extends Component
{
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        session()->flash('message', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function delete($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
        }
    }

    public function render()
    {
        $notifications = Auth::user()->notifications()->latest()->get();

        return view('livewire.client.notifications', [
            'notifications' => $notifications
        ]);
    }
}