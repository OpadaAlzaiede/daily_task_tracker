<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Recurring tasks') }}
            </h2>
            <a href="{{ route('recurring-tasks.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <i class="fas fa-file-pdf"></i>
                <span>Add Recurring Task</span>
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
                                        Frequency
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        Frequency unit
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        Start date
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        Next due date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recurringTasks as $recurringTask)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-3 py-4">
                                            {{ $recurringTask->title }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $recurringTask->category->name }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $recurringTask->frequency }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ App\Enums\RecurringTaskUnit::tryFrom($recurringTask->frequency_unit)->name }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $recurringTask->start_date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $recurringTask->next_due_date->format('d/m/Y') }}
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <a href="{{ route('recurring-tasks.show', $recurringTask->id) }}" class="font-small text-green-600 dark:text-green-500 hover:underline ms-3">SHOW</a>
                                            <a href="{{ route('recurring-tasks.edit', $recurringTask->id) }}" class="font-small text-blue-600 dark:text-blue-500 hover:underline ms-3">EDIT</a>
                                            <form action="{{ route('recurring-tasks.destroy', $recurringTask->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-small text-red-600 dark:text-red-500 hover:underline ms-3">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 py-4">
                        {{ $recurringTasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
