<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Recurring Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('recurring-tasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            @if($errors->has('title'))
                                <div class="text-red-500 text-xs">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="mb-5">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            @if($errors->has('description'))
                                <div class="text-red-500 text-xs">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                        <div class="mb-5">
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option selected>Choose a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <div class="text-red-500 text-xs">{{ $errors->first('category_id') }}</div>
                            @endif
                        </div>
                        <div class="mb-5">
                            <label for="frequency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Frequency</label>
                            <input type="number" name="frequency" value="{{ old('frequency') }}" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            @if($errors->has('frequency'))
                                <div class="text-red-500 text-xs">{{ $errors->first('frequency') }}</div>
                            @endif
                        </div>
                        <div class="mb-5">
                            <label for="frequency_unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Frequency unit</label>
                            <select id="frequency_unit" name="frequency_unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option selected>Choose a unit</option>
                                @foreach(\App\Enums\RecurringTaskUnit::cases() as $unit)
                                    <option value="{{ $unit->value }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('frequency_unit'))
                                <div class="text-red-500 text-xs">{{ $errors->first('frequency_unit') }}</div>
                            @endif
                        </div>
                        <div class="mb-5">
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start date</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            @if($errors->has('start_date'))
                                <div class="text-red-500 text-xs">{{ $errors->first('start_date') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
