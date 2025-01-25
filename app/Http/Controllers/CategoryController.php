<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $attributes = $request->validated();

        if (empty($attributes['slug'])) {
            $attributes['slug'] = Str::slug($attributes['name']);
        }

        $existingCategory = Category::where('slug', $attributes['slug'])->first();
        if ($existingCategory) {
            return redirect()->back()->withErrors(['slug' => 'The slug already exists.']);
        }

        Category::create($attributes);

        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    public function show(Request $request, $slug)
    {
        $currentDateTime = Carbon::now();
        $search = $request->input('search');

        $category_id = Category::where('slug', $slug)->value('id');

        $eventsQuery = Event::where('start_time', '>=', $currentDateTime);

        if ($search) {
            $eventsQuery->where('name', 'like', '%' . $search . '%');
        }

        if ($category_id) {
            $eventsQuery->where('category_id', $category_id);
        }

        $events = $eventsQuery->orderBy('start_time', 'asc')->get();

        $categories = Category::all();

        return view('events.index', compact('events', 'search', 'categories'));
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $attributes = $request->validated();

        if (empty($attributes['slug'])) {
            $attributes['slug'] = Str::slug($attributes['name']);
        }

        $existingCategory = Category::where('slug', $attributes['slug'])
            ->where('id', '!=', $category->id)
            ->first();

        if ($existingCategory) {
            return redirect()->back()->withErrors(['slug' => 'The slug already exists.']);
        }

        $category->update($attributes);

        return redirect()->route('categories.index')->with('message', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
