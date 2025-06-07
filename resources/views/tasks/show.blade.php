<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-1">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100">
                    <div class="relative max-w-2xl mx-auto group">
                        <!-- Glow effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl opacity-20 group-hover:opacity-30 blur transition duration-500"></div>

                        <!-- Main card -->
                        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-lg dark:hover:shadow-purple-900/20">
                            <!-- Gradient status bar -->
                            <div class="h-1.5 w-full @if($task->completed_at) bg-gradient-to-r from-green-400 to-emerald-600
                                @elseif(now() > $task->due_date) bg-gradient-to-r from-rose-500 to-pink-600
                                @else bg-gradient-to-r from-blue-400 to-indigo-500 @endif"></div>

                            <div class="p-6">
                                <!-- Header with title and status chip -->
                                <div class="flex justify-between items-start gap-4">
                                    <h3 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                                        {{ $task->title }}
                                    </h3>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wide
                                        @if($task->completed_at) bg-green-500/10 text-green-600 dark:text-green-300
                                        @else bg-blue-500/10 text-blue-600 dark:text-blue-300 @endif">
                                        @if($task->completed_at)
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                            Completed
                                        @else
                                            <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                            Pending
                                        @endif
                                    </span>
                                </div>

                                <!-- Description with fade effect -->
                                <div class="mt-4">
                                    <p class="text-gray-600 dark:text-gray-300 font-light leading-relaxed">
                                        {{ $task->description }}
                                    </p>
                                </div>

                                <!-- Metadata grid with icons -->
                                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="p-2 rounded-lg bg-purple-100/50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Category</p>
                                            <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $task->category->name }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-3">
                                        <div class="p-2 rounded-lg @if(!$task->completed_at && now() > $task->due_date) bg-rose-100/50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-300 @else bg-blue-100/50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-300 @endif">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Due Date</p>
                                            <p class="mt-1 text-sm font-medium @if(!$task->completed_at && now() > $task->due_date) text-rose-600 dark:text-rose-400 @else text-gray-900 dark:text-white @endif">
                                                {{ $task->due_date->format('M d, Y') }}
                                                @if(!$task->completed_at && now() > $task->due_date)
                                                    <span class="ml-1">(Overdue)</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
