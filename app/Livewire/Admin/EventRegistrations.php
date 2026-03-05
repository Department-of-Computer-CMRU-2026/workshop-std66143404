<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

class EventRegistrations extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event->load('registrations.user');
    }

    public function render()
    {
        return view('livewire.admin.event-registrations')->layout('layouts.app')->title('Registrations for ' . $this->event->title);
    }
}
