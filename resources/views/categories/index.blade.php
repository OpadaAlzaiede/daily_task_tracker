<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <a href="{{ route('categories.create') }}" class="fixed bottom-8 right-8 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2 z-50">
            <i class="fas fa-file-pdf text-xl"></i>
                <span>Add Category</span>
        </a>
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
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-3 py-4">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ $category->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <a href="{{ route('categories.show', $category->id) }}" class="font-small text-green-600 dark:text-green-500 hover:underline ms-3">SHOW</a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="font-small text-blue-600 dark:text-blue-500 hover:underline ms-3">EDIT</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
