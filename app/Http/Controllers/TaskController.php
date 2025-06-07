<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Tasks\StoreRequest;
use App\Http\Requests\Tasks\UpdateRequest;

class TaskController extends Controller
{
    /**
     * List all tasks.
     *
     * @return View
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
     *
     * @param Task $task
     *
     * @return View
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return View
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
     *
     * @param StoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Task::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'due_date' => $request->validated('due_date'),
            'user_id' => auth()->user()->id,
            'category_id' => $request->validated('category_id'),
        ]);

        return redirect()->route('tasks.index')->with('message', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param Task $task
     *
     * @return View
     */
    public function edit(Task $task): View
    {
        $categories = Category::query()
                        ->where('user_id', auth()->user()->id)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified task.
     *
     * @param UpdateRequest $request
     * @param Task $task
     *
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully.');
    }

    /**
     * Remove the specified task.
     *
     * @param Task $task
     *
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully.');
    }

    /**
     * Mark task as completed.
     *
     * @param Task $task
     *
     * @return RedirectResponse
     */
    public function complete(Task $task): RedirectResponse
    {
        $task->completed_at = now();
        $task->save();

        return redirect()->route('tasks.index')->with('message', 'Task completed successfully.');
    }

    /**
     * Mark task as incomplete.
     *
     * @param Task $task
     *
     * @return RedirectResponse
     */
    public function incomplete(Task $task): RedirectResponse
    {
        $task->completed_at = null;
        $task->save();

        return redirect()->route('tasks.index')->with('message', 'Task incompleted successfully.');
    }
}
