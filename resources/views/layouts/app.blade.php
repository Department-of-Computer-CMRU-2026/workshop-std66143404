@if(auth()->user()->isAdmin())
    <x-layouts::app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts::app.sidebar>
@else
    @include('layouts.student', ['title' => $title ?? null, 'slot' => $slot])
@endif
