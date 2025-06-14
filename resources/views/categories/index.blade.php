<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <i class="fas fa-file-pdf"></i>
                <span>Add Category</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-20 text-gray-900 dark:text-gray-100">
                    @if(session()->has('message'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <span class="font-medium">{{ session('message') }}</span>
                        </div>
                    @endif

                    <x-table
                        :headers="['Name', 'Created At', '# of Tasks']"
                        :rows="$categories->map(function($category) {
                            return [
                                'cells' => [
                                    $category->name,
                                    $category->created_at->format('d/m/Y'),
                                    $category->tasks_count,
                                ],
                                'show' => route('categories.show', $category->id),
                                'edit' => route('categories.edit', $category->id),
                                'delete' => route('categories.destroy', $category->id)
                            ];
                        })"
                        :pagination="$categories->links()"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
