<?php
namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;
class TodoList extends Component
{
    use WithPagination;
    
    public $id;
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|min:3|max:50',
        'description' => 'required|min:3|max:50',
    ];

    public function mount()
    {
        $this->id = 0;
        $this->title = '';
        $this->description = '';
    }

    public function create()
    {
        $this->validate();

        Todo::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description
        ]);

        session()->flash('success', 'Todo Created Successfully.');
        $this->cancel();
        $this->resetPage();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();
        
        $this->id = $id;
        
        $todo = Todo::find($id);
        $this->title = $todo->title;
        $this->description = $todo->description;

    }

    public function delete($id)
    {
        try {
            Todo::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete todo!');
            return;
        }
        $this->cancel();
        session()->flash('success', 'Todo Deleted Successfully.');
    }

    function toggle($id)
    {
        $todo = Todo::find($id);
        $todo->status = !$todo->status;
        $todo->save();

        $this->cancel();
    }

    public function update($id)
    {
        $this->validate();

        Todo::find($id)
            ->update([
                'title' => $this->title,
                'description' => $this->description,
                'updated_at' => now(),
            ]);

        session()->flash('success', 'Todo Updated Successfully.');
        $this->cancel();

    }

    public function cancel()
    {
        $this->reset(['id', 'title', 'description']);
        $this->resetPage();

    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()
                ->where('user_id', auth()->id())
                ->paginate(3),
        ]);
    }
}