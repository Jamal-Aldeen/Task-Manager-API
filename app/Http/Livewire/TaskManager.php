<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{
    public $tasks;
    public $title = '';
    public $editingTask = null;
    public $editingTitle = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
    ];

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = auth()->user()->tasks()->latest()->get();
    }

    public function addTask()
    {
        $this->validate();

        Task::create([
            'title' => $this->title,
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        $this->title = '';
        $this->loadTasks();
        session()->flash('message', 'Task added successfully!');
    }

    public function editTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        
        if ($task->user_id !== auth()->id()) {
            return;
        }

        $this->editingTask = $taskId;
        $this->editingTitle = $task->title;
    }

    public function updateTask()
    {
        $this->validate([
            'editingTitle' => 'required|min:3|max:255',
        ]);

        $task = Task::findOrFail($this->editingTask);
        
        if ($task->user_id !== auth()->id()) {
            return;
        }

        $task->update([
            'title' => $this->editingTitle,
        ]);

        $this->editingTask = null;
        $this->editingTitle = '';
        $this->loadTasks();
        session()->flash('message', 'Task updated successfully!');
    }

    public function cancelEdit()
    {
        $this->editingTask = null;
        $this->editingTitle = '';
    }

    public function toggleStatus($taskId)
    {
        $task = Task::findOrFail($taskId);
        
        if ($task->user_id !== auth()->id()) {
            return;
        }

        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed',
        ]);

        $this->loadTasks();
    }

    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        
        if ($task->user_id !== auth()->id()) {
            return;
        }

        $task->delete();
        $this->loadTasks();
        session()->flash('message', 'Task deleted successfully!');
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
