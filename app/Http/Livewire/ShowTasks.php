<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Estado;
use App\Models\Priority;
use App\Models\Tasks;


class ShowTasks extends Component
{
    use WithPagination;
    public $task;
    public $search;
    public $estadoId;
    public $estados;
    public $categories;
    public $priorities;
    public $task_categories;
    public $open_edit = false;
    public $open_comment = false;
    public $selectedCategories = [];
    public $commenttopost;
    public $taskId;
    public $readyToLoad = false;
    public $defaultCategories;
    public $userCategories;
    protected $listeners = ['render', 'delete', 'commentsUpdate' => 'updateComments', 'deleteComment'];

    protected $rules = [
        'task.title' => 'required|max:100',
        'task.description' => 'required|min:10',
        'task.deadline' => 'required',
        'task.state_id' => 'required',
        'task.priority_id' => 'required',
        'selectedCategories' => 'required',
        'task.color' => 'required'
    ];

    public function mount(Tasks $task)
    {
        $this->task = $task;
        $this->loadCategories();
        $this->loadPriorities();
        $this->task_categories = $this->task->categories;
        $this->selectedCategories = $this->task_categories->pluck('id');
        $this->defaultCategories = Category::whereNull('user_id')->get();
        $this->userCategories = Category::where('user_id', Auth::id())->get();
        if ($this->task->state_id == 5) {
            $this->estados = Estado::where('id', '!=', 5)->get();
        } else {
            $this->estados = Estado::all();
        }
    }

    public function loadCategories()
    {
        $this->categories = Category::where('user_id', Auth::id())
            ->orWhereNull('user_id')
            ->get();
    }

    public function loadPriorities()
    {
        $this->priorities = Priority::where('user_id', Auth::id())
            ->orWhereNull('user_id')
            ->get();
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $query = Tasks::with(['categories', 'priority'])
                ->where('user_id', Auth::user()->id)
                ->where('title', 'like', $this->search . '%')
                ->orderBy('id', 'DESC');
            if ($this->estadoId) {
                $query->where('state_id', $this->estadoId);
            }
            $tasksuser = $query->paginate(10);
        } else {
            $tasksuser = [];
        }


        return view('livewire.show-tasks', [
                    'tasksuser' => $tasksuser,
                    'estado' => Estado::all(),
                ])
            ->layout('layouts.app');

    }

    public function loadTasks()
    {
        $this->readyToLoad = true;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(Tasks $task)
    {
        $this->task = $task;
        $this->selectedCategories = $this->task->categories->pluck('id');
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        $this->task->save();
        if (!empty($this->selectedCategories)) {
            $this->task->categories()->sync($this->selectedCategories);
        }
        $this->emit('alertupdate', 'se actualizo');
        $this->reset(['open_edit']);
    }

    public function delete(Tasks $taskId)
    {
        $taskId->categories()->detach();
        $taskId->delete();
    }

    public function addcomment($taskId)
    {
        $this->open_comment = true;
        $this->taskId = $taskId;
        $this->task = Tasks::with([
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->find($this->taskId);
    }
    public function postcomment()
    {
        $this->validate(['commenttopost' => 'required']);
        $comment = new Comment();
        $comment->task_id = $this->taskId;
        $comment->user_id = auth()->id();
        $comment->content = $this->commenttopost;
        $comment->save();
        $this->emit('commentAdded');
        $this->emit('commentsUpdate');
        $this->commenttopost = '';
    }
    public function updateComments()
    {
        $this->task = Tasks::with([
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->find($this->taskId);
    }
    public function deleteComment(Comment $commentId)
    {
        $commentId->delete();
        $this->emit('commentsUpdate');
    }
}