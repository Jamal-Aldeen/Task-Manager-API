<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Add Task Form -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Task</h3>
                <form wire:submit.prevent="addTask" class="flex gap-4">
                    <div class="flex-1">
                        <input 
                            wire:model.defer="title" 
                            type="text" 
                            placeholder="Enter task title..." 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror">
                        @error('title') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Add Task</span>
                        <span wire:loading>Adding...</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Your Tasks</h3>
                
                @if($tasks && $tasks->count() > 0)
                    <div class="space-y-3">
                        @foreach($tasks as $task)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3 flex-1">
                                    <!-- Status Toggle -->
                                    <button 
                                        wire:click="toggleStatus({{ $task->id }})"
                                        class="flex-shrink-0">
                                        @if($task->status === 'completed')
                                            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                        @endif
                                    </button>

                                    <!-- Task Title -->
                                    <div class="flex-1">
                                        @if($editingTask === $task->id)
                                            <form wire:submit.prevent="updateTask" class="flex gap-2">
                                                <input 
                                                    wire:model.defer="editingTitle" 
                                                    type="text" 
                                                    class="flex-1 px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('editingTitle') border-red-500 @enderror">
                                                <button 
                                                    type="submit" 
                                                    class="px-3 py-1 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">
                                                    Save
                                                </button>
                                                <button 
                                                    type="button" 
                                                    wire:click="cancelEdit"
                                                    class="px-3 py-1 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700">
                                                    Cancel
                                                </button>
                                            </form>
                                            @error('editingTitle') 
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                            @enderror
                                        @else
                                            <span class="text-gray-900 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                {{ $task->title }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Status Badge -->
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </div>

                                <!-- Action Buttons -->
                                @if($editingTask !== $task->id)
                                    <div class="flex items-center space-x-2 ml-4">
                                        <button 
                                            wire:click="editTask({{ $task->id }})"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button 
                                            wire:click="deleteTask({{ $task->id }})"
                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                            class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new task.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
