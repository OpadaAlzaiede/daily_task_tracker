<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Categories') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-20 text-gray-900 dark:text-gray-100">
                    <div class="mb-5">
                        {{ $category->name }}
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="mb-5 mt-5 text-center">
                            Tasks
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Due date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Complete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->tasks as $task)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-3 py-4">
                                            {{ $task->title }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $task->due_date->format('d/m/Y') }}
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <a href="{{ route('tasks.show', $category->id) }}" class="font-small text-green-600 dark:text-green-500 hover:underline ms-3">SHOW</a>
                                            <a href="{{ route('tasks.edit', $category->id) }}" class="font-small text-blue-600 dark:text-blue-500 hover:underline ms-3">EDIT</a>
                                            <form action="{{ route('tasks.destroy', $category->id) }}" method="POST">
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
                                                        <input onChange="this.form.submit()" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                </form>
                                            @else
                                                <form action="{{ route('tasks.incomplete', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="flex items-center mb-4 text-center">
                                                        <input onChange="this.form.submit()" type="checkbox" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
