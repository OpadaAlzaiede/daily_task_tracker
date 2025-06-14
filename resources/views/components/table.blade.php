@props([
    'headers' => [],
    'rows' => [],
    'actions' => true,
    'pagination' => null,
    'checkbox' => false,
    'checkboxAction' => null,
])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-medium text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-6 py-3">
                        {{ $header }}
                    </th>
                @endforeach

                @if($actions)
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                @endif

                @if($checkbox)
                    <th scope="col" class="px-6 py-3">
                        Complete
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    @foreach($row['cells'] as $cell)
                        <td class="px-9 py-5">
                            {{ $cell }}
                        </td>
                    @endforeach

                    @if($actions)
                        <td class="flex px-6 py-4">
                            @if(isset($row['show']))
                                <a href="{{ $row['show'] }}" class="font-small text-green-600 dark:text-green-500 hover:underline ms-3">SHOW</a>
                            @endif

                            @if(isset($row['edit']))
                                <a href="{{ $row['edit'] }}" class="font-small text-blue-600 dark:text-blue-500 hover:underline ms-3">EDIT</a>
                            @endif

                            @if(isset($row['delete']))
                                <form action="{{ $row['delete'] }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-small text-red-600 dark:text-red-500 hover:underline ms-3">DELETE</button>
                                </form>
                            @endif
                        </td>
                    @endif

                    @if($checkbox && isset($row['checkbox']))
                        <td class="px-6 py-4">
                            <form action="{{ $row['checkbox']['action'] }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="flex items-center mb-4 text-center">
                                    <input onChange="this.form.submit()" type="checkbox"
                                        {{ $row['checkbox']['checked'] ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
