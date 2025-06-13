<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * List all categories.
     */
    public function index(): View
    {
        $categories = Category::query()
            ->withCount('tasks')
            ->where('user_id', auth()->user()->id)
            ->orderBy('tasks_count', 'DESC')
            ->paginate(5);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show category.
     */
    public function show(Category $category): View
    {
        if (request()->user()->cannot('view', $category)) {
            abort(403);
        }

        $category->loadMissing('tasks');

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a new category.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Category::create([
            'name' => $request->validated('name'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        if (request()->user()->cannot('update', $category)) {
            abort(403);
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function update(UpdateRequest $request, Category $category): RedirectResponse
    {
        if (request()->user()->cannot('update', $category)) {
            abort(403);
        }

        $category->update($request->validated());

        return redirect()->route('categories.index')->with('message', 'Category updated successfully.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        if (request()->user()->cannot('delete', $category)) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Category deleted successfully.');
    }
}
