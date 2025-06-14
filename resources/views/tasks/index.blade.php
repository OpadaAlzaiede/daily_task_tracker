<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <i class="fas fa-file-pdf"></i>
                <span>Add Task</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('tasks.index') }}" method="GET" class="mb-6">
                    <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800 transition-colors duration-300">
                        <div class="flex flex-col md:flex-row gap-4 md:gap-6">
                            <!-- Category Select -->
                            <div class="flex-1">
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Category
                                </label>
                                <div class="relative">
                                    <select
                                        id="category"
                                        name="category_id"
                                        class="w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 appearance-none"
                                    >
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Date Range
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="from_date" class="sr-only">From date</label>
                                        <div class="relative">
                                            <input
                                                type="date"
                                                id="from_date"
                                                name="from_date"
                                                value="{{ request('from_date') }}"
                                                class="w-full pl-3 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                            >
                                        </div>
                                    </div>
                                    <div>
                                        <label for="to_date" class="sr-only">To date</label>
                                        <div class="relative">
                                            <input
                                                type="date"
                                                id="to_date"
                                                name="to_date"
                                                value="{{ request('to_date') }}"
                                                class="w-full pl-3 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Select -->
                            <div class="flex-1">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Status
                                </label>
                                <div class="relative">
                                    <select
                                        id="status"
                                        name="status"
                                        class="w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 appearance-none"
                                    >
                                        <option value="">All Statuses</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="incomplete" {{ request('status') == 'incomplete' ? 'selected' : '' }}>Incomplete</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <button
                                type="button"
                                onclick="this.form.reset()"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors"
                            >
                                Reset
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors"
                            >
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
                <div class="p-20 text-gray-900 dark:text-gray-100">
                    @if(session()->has('message'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <span class="font-medium">{{ session('message') }}</span>
                        </div>
                    @endif

                    <x-table
                        :headers="['Title', 'Category', 'Created At', 'Due Date']"
                        :rows="$tasks->map(function($task) {
                            return [
                                'cells' => [
                                    $task->title,
                                    $task->category->name,
                                    $task->created_at->format('d/m/Y'),
                                    $task->due_date->format('d/m/Y'),
                                ],
                                'show' => route('tasks.show', $task->id),
                                'edit' => route('tasks.edit', $task->id),
                                'delete' => route('tasks.destroy', $task->id),
                                'checkbox' => [
                                    'action' => $task->completed_at ?
                                        route('tasks.incomplete', $task->id) :
                                        route('tasks.complete', $task->id),
                                    'checked' => !is_null($task->completed_at)
                                ]
                            ];
                        })"
                        checkbox
                    />
                    <div class="mt-5 py-4">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
