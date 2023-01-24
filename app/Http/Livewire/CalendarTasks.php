<?php

namespace App\Http\Livewire;

use App\Models\Tasks;
use Carbon\Carbon;
use Livewire\Component;

class CalendarTasks extends Component
{
    public $tasks;

    public function mount()
    {
        $this->tasks = Tasks::where('user_id', auth()->user()->id)->get();
        $this->tasks = $this->tasks->map(function ($task) {
            return [
                'title' => $task->title,
                'start' => Carbon::parse($task->created_at)->format('Y-m-d h:i'),
                'end' => Carbon::parse($task->deadline)->format('Y-m-d'),
                'description' => $task->description,
                'color' => $task->color,
                'textColor' => '#fff',
            ];
        });
    }
    public function render()
    {
        return view('livewire.calendar-tasks', ['tasks' => $this->tasks]);
    }

}