<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\StoreRequest;
use App\Http\Requests\Tasks\UpdateRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * List all tasks.
     */
    public function index(): View
    {
        $tasks = Task::query()
            ->with('category:id,name')
            ->select([
                'id',
                'title',
                'category_id',
                'due_date',
                'completed_at',
            ])
            ->where('user_id', auth()->user()->id)
            ->orderBy('due_date', 'DESC')
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show task.
     */
    public function show(Task $task): View
    {
        if (request()->user()->cannot('view', $task)) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(): View
    {
        $categories = Category::query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a new task.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Task::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'due_date' => $request->validated('due_date'),
            'user_id' => auth()->user()->id,
            'category_id' => $request->validated('category_id'),
            'completed_at' => $request->validated('completed_at') ?? null,
        ]);

        return redirect()->route('tasks.index')->with('message', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task): View
    {
        if (request()->user()->cannot('update', $task)) {
            abort(403);
        }

        $categories = Category::query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified task.
     */
    public function update(UpdateRequest $request, Task $task): RedirectResponse
    {
        if (request()->user()->cannot('update', $task)) {
            abort(403);
        }

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully.');
    }

    /**
     * Remove the specified task.
     */
    public function destroy(Task $task): RedirectResponse
    {
        if (request()->user()->cannot('delete', $task)) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully.');
    }

    /**
     * Mark task as completed.
     */
    public function complete(Task $task): RedirectResponse
    {
        $task->completed_at = now();
        $task->save();

        return redirect()->route('tasks.index')->with('message', 'Task marked as completed successfully!');
    }

    /**
     * Mark task as incomplete.
     */
    public function incomplete(Task $task): RedirectResponse
    {
        $task->completed_at = null;
        $task->save();

        return redirect()->route('tasks.index')->with('message', 'Task marked as incomplete successfully!');
    }
}
