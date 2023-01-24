@section('title', 'Inicio | To-Do Hero')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl color-1fx3 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('task-summary')
            <div class="bg-white shadow-default rounded overflow-hidden p-2">
                @livewire('calendar-tasks')
            </div>
        </div>
    </div>
</x-app-layout>
