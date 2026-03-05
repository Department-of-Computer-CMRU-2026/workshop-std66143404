<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventList extends Component
{
    public function register($eventId)
    {
        $user = Auth::user();

        // Constraint 1: Maximum 3 events per student
        if ($user->registrations()->count() >= 3) {
            session()->flash('error', 'You can only register for a maximum of 3 events.');
            return;
        }

        $event = Event::findOrFail($eventId);

        // Constraint 2: Prevent registration if event is full
        if ($event->remaining_seats <= 0) {
            session()->flash('error', 'This event is full.');
            return;
        }

        // Constraint 3: Prevent double registration (business logic check before DB unique constraint)
        if ($user->registrations()->where('event_id', $eventId)->exists()) {
            session()->flash('error', 'You are already registered for this event.');
            return;
        }

        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        session()->flash('message', 'Successfully registered for ' . $event->title);
    }

    public function render()
    {
        $user = Auth::user();
        $registeredEventIds = $user->registrations->pluck('event_id')->toArray();
        $events = Event::withCount('registrations')->get();

        return view('livewire.events.event-list', [
            'events' => $events,
            'registeredEventIds' => $registeredEventIds,
            'registrationCount' => count($registeredEventIds)
        ])->layout('layouts.app')->title('Events');
    }
}
