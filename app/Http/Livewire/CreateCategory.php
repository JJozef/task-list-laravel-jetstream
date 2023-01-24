<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CategoryTask;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateCategory extends Component
{
    public $open_cat = false;
    public $isEditing = false;
    public $categories;
    public $category;

    public $name, $description, $backgroundcolor;

    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'name' => 'required|max:15|unique:categories,name',
        'description' => 'required|min:10|max:50',
        'backgroundcolor' => 'required',
    ];

    public function save()
    {
        $this->validate();
        Category::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'backgroundcolor' => $this->backgroundcolor
        ]);

        $lastCategoryName = Category::latest()->first()->name;
        $this->reset(['name', 'description', 'backgroundcolor']);
        $this->emitTo('show-tasks', 'render');
        $this->emit('refreshCategories');
        $this->emit('alertcat', $lastCategoryName);
        $this->categories = Category::where('user_id', Auth::id())->get();
    }
    public function editcat(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->backgroundcolor = $category->backgroundcolor;
        $this->isEditing = true;
    }
    public function mount()
    {
        $this->categories = Category::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();
    }
    public function render()
    {
        return view('livewire.create-category');
    }
    public function update()
    {
        $this->validate();
        $this->category->name = $this->name;
        $this->category->description = $this->description;
        $this->category->backgroundcolor = $this->backgroundcolor;
        $this->category->save();
        $this->emit('alertupdatecat', 'se actualizo');
        $this->emitTo('show-tasks', 'render');
        $this->emitTo('create-tasks', 'render');
        $this->reset(['isEditing', 'name', 'description', 'backgroundcolor']);
        $this->emitSelf('render');
    }
    public function cancel()
    {
        $this->name = "";
        $this->description = "";
        $this->backgroundcolor = "";
        $this->isEditing = false;
    }

    public function delete(Category $catId)
    {
        $categoryTasks = CategoryTask::where('category_id', $catId->id)->get();
        if ($categoryTasks->count() > 0) {
            $this->emit('alertNoDelCat', 'La categoría no se puede eliminar ya que tiene tareas asociadas');
        } else {
            $catId->delete();
            $this->categories = Category::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
            $this->emit('alertYesDelCat', 'La categoría <b>se elimino</b> correctamente!');
            $this->emitTo('create-tasks', 'render');
            $this->emitTo('show-tasks', 'render');
        }
    }
}