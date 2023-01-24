<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CategoryTask;
use App\Models\Estado;
use App\Models\Priority;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTasks extends Component
{
    protected $listeners = ['render', 'refreshCategories'];
    public $open = false;

    public $title, $description, $deadline, $color, $state, $priorityinsert, $categoryinsert;
    protected $rules = [
        'title' => 'required|max:100',
        'description' => 'required|min:10',
        'deadline' => 'required',
        'state' => 'required',
        'priorityinsert' => 'required',
        'categoryinsert' => 'required',
        'color' => 'required'
    ];

    public $estados;
    public $categories;
    public $defaultCategories;
    public $priorities;

    public function save()
    {
        $this->validate();
        $user_id = Auth::id();
        Tasks::create([
            'user_id' => $user_id,
            'state_id' => $this->state,
            'priority_id' => $this->priorityinsert,
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'color' => $this->color,
        ]);

        // Obtener el último ID de tarea insertado
        $lastTaskId = Tasks::latest()->first()->id;

        // Recorrer todas las categorías seleccionadas
        foreach (explode(",", $this->categoryinsert) as $category) {
            CategoryTask::create([
                'category_id' => $category,
                'tasks_id' => $lastTaskId
            ]);
        }
        $lastTaskTitle = Tasks::latest()->first()->title;
        $this->reset(['open', 'title', 'description', 'deadline', 'state', 'categoryinsert', 'priorityinsert', 'color']);
        $this->emitTo('show-tasks', 'render');
        $this->emit('alert', $lastTaskTitle);
    }


    public function mount()
    {
        $this->estados = Estado::where('id', '!=', 5)->where('name', '!=', 'Expirada')->get();
        $this->loadPriorities();
        $this->refreshCategories();
        $this->defaultCategories = Category::whereNull('user_id')->get();
    }
    public function loadPriorities()
    {
        $user_id = Auth::id();
        $this->priorities = Priority::where('user_id', $user_id)
            ->orWhereNull('user_id')
            ->get();
    }
    public function render()
    {
        return view('livewire.create-tasks');
    }
    public function updatingOpen()
    {
        if ($this->open == false) {
            $this->reset(['title', 'description', 'deadline', 'state', 'categoryinsert', 'priorityinsert']);
            $this->emit('resetCKEditor');
        }
    }
    public function refreshCategories()
    {
        $this->categories = Category::where('user_id', Auth::id())->get();
    }
}