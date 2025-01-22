<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        Category::create($attributes);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
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

    public function update(Request $request, Category $category)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category->update($attributes);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
