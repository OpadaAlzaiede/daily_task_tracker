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
                <div class="p-20 text-gray-900 dark:text-gray-100">
                    <div class="mb-5 text-center">
                        @if(session()->has('message'))
                            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                <span class="font-medium">{{ session('message') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-2 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        Due date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        Complete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-3 py-4">
                                            {{ $task->title }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $task->category->name }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $task->due_date->format('d/m/Y') }}
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <a href="{{ route('tasks.show', $task->id) }}" class="font-small text-green-600 dark:text-green-500 hover:underline ms-3">SHOW</a>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="font-small text-blue-600 dark:text-blue-500 hover:underline ms-3">EDIT</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-small text-red-600 dark:text-red-500 hover:underline ms-3">DELETE</button>
                                            </form>
                                        </td>
                                        <td class="px-3 py-4">
                                            @if(is_null($task->completed_at))
                                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="flex items-center mb-4 text-center">
                                                        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                </form>
                                            @else
                                                <form action="{{ route('tasks.incomplete', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="flex items-center mb-4 text-center">
                                                        <input id="default-checkbox" checked type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 py-4">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
