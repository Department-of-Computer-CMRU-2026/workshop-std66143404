<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

class EventsManager extends Component
{
    public $events = [];

    public $title, $speaker, $location, $total_seats;
    public $editingEventId = null;
    public $showModal = false;

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Event::withCount('registrations')->get();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->editingEventId = $id;
        $this->title = $event->title;
        $this->speaker = $event->speaker;
        $this->location = $event->location;
        $this->total_seats = $event->total_seats;
        $this->showModal = true;
    }

    public function delete($id)
    {
        Event::findOrFail($id)->delete();
        $this->loadEvents();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string',
            'speaker' => 'required|string',
            'location' => 'required|string',
            'total_seats' => 'required|integer|min:1',
        ]);

        Event::updateOrCreate(['id' => $this->editingEventId], [
            'title' => $this->title,
            'speaker' => $this->speaker,
            'location' => $this->location,
            'total_seats' => $this->total_seats,
        ]);

        $this->showModal = false;
        $this->loadEvents();
        $this->resetInputFields();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->speaker = '';
        $this->location = '';
        $this->total_seats = '';
        $this->editingEventId = null;
    }

    public function render()
    {
        return view('livewire.admin.events-manager')->layout('layouts.app')->title('Manage Events');
    }
}
