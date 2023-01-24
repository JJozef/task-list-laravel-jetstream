<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\Estado;

class TaskSummary extends Component
{
    public $tasksSummary;

    public function mount()
    {
        $tasksSummary = Tasks::where('user_id', Auth::user()->id)->get()->groupBy('state_id')->map(function ($tasks) {
            return $tasks->count();
        });

        $allStates = Estado::get();
        $allStates = $allStates->map(function ($state) use ($tasksSummary) {
            $state->tasks = $tasksSummary->get($state->id, 0);
            return $state;
        });

        $this->tasksSummary = $allStates;
    }

    public function render()
    {
        return view('livewire.task-summary', ['tasksSummary' => $this->tasksSummary]);
    }
}