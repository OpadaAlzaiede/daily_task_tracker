<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecurringTasks\StoreRequest;
use App\Models\Category;
use App\Models\RecurringTask;
use Illuminate\Http\RedirectResponse;

class RecurringTaskController extends Controller
{
    public function index()
    {
        $recurringTasks = RecurringTask::query()
            ->with('category:id,name')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('recurring-tasks.index', compact('recurringTasks'));
    }

    public function show(RecurringTask $recurringTask)
    {
        if (request()->user()->cannot('view', $recurringTask)) {
            abort(403);
        }

        return view('recurring-tasks.show', compact('recurringTask'));
    }

    public function create()
    {
        $categories = Category::query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('recurring-tasks.create', compact('categories'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        RecurringTask::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'category_id' => $request->validated('category_id'),
            'user_id' => auth()->user()->id,
            'frequency' => $request->validated('frequency'),
            'frequency_unit' => $request->validated('frequency_unit'),
            'start_date' => $request->validated('start_date'),
            'next_due_date' => $request->validated('start_date'),
        ]);

        return redirect()->route('recurring-tasks.index')->with('message', 'Recurring task created successfully.');
    }

    public function destroy(RecurringTask $recurringTask): RedirectResponse
    {
        if (request()->user()->cannot('delete', $recurringTask)) {
            abort(403);
        }

        $recurringTask->delete();

        return redirect()->route('recurring-tasks.index')->with('message', 'Recurring task deleted successfully.');
    }
}
